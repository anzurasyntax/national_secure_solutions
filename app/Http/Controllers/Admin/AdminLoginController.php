<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()
                ->route('student.dashboard')
                ->with('status', 'You are already signed in with a student account. Sign out first if you need to use an administrator account.');
        }

        return view('admin.auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'These credentials do not match our records.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();
        if ($user === null) {
            return redirect()->route('admin.login');
        }

        if (! $user->is_admin) {
            Auth::logout();
            $request->session()->regenerateToken();

            return back()
                ->withErrors(['email' => 'This sign-in is for administrators only. Students and course buyers use the main site login.'])
                ->onlyInput('email');
        }

        $this->forgetNonAdminIntendedUrl($request);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Keep url.intended only when it targets the admin panel (not student or public routes).
     */
    private function forgetNonAdminIntendedUrl(Request $request): void
    {
        $url = $request->session()->get('url.intended');
        if ($url === null) {
            return;
        }

        $path = parse_url($url, PHP_URL_PATH) ?: '';
        $ok = str_starts_with($path, '/admin')
            && ! str_starts_with($path, '/admin/login');

        if (! $ok) {
            $request->session()->forget('url.intended');
        }
    }
}
