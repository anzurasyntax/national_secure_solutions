<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CoursePurchaseService;
use App\Support\SafeInternalRedirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            return redirect()->route($user->is_admin ? 'admin.dashboard' : 'student.dashboard');
        }

        return view('auth.login');
    }

    public function store(Request $request, CoursePurchaseService $purchaseService): RedirectResponse
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
            return redirect()->route('login');
        }

        if ($user->is_admin) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Administrator accounts use the admin sign-in page: '.url('/admin/login'),
            ])->onlyInput('email');
        }

        $this->forgetAdminIntendedUrlIfStudent($request, $user);

        try {
            $purchaseService->attachPaidOrdersForUser($user);
        } catch (\Throwable $e) {
            report($e);
        }

        $to = SafeInternalRedirect::courseCheckoutPath($request->input('redirect'));
        if ($to !== null) {
            return redirect()->to($to);
        }

        return redirect()->intended(route('student.dashboard'));
    }

    /**
     * Guests redirected from /admin store url.intended; students would be sent there after login and get 403.
     */
    private function forgetAdminIntendedUrlIfStudent(Request $request, User $user): void
    {
        if ($user->is_admin) {
            return;
        }

        $url = $request->session()->get('url.intended');
        if ($url === null) {
            return;
        }

        $path = parse_url($url, PHP_URL_PATH) ?: '';
        if (str_starts_with($path, '/admin')) {
            $request->session()->forget('url.intended');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
