<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CoursePurchaseService;
use App\Support\SafeInternalRedirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function store(Request $request, CoursePurchaseService $purchaseService): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $name = trim($validated['name']);
        $parts = preg_split('/\s+/u', $name, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $first = $parts[0] ?? '';
        $last = count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : '';

        $user = User::create([
            'name' => $name,
            'first_name' => $first,
            'last_name' => $last,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        try {
            $purchaseService->attachPaidOrdersForUser($user);
        } catch (\Throwable $e) {
            report($e);
        }

        $to = SafeInternalRedirect::courseCheckoutPath($request->input('redirect'));

        return redirect()->to($to ?? route('student.dashboard'));
    }
}
