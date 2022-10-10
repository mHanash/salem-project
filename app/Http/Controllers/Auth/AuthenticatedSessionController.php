<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check('saSalemFin', $user->password)) {
                return redirect()->route('newPassword');
            }
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function newPassword()
    {
        $user = Auth::user();
        return view('auth.new-password', ['user' => $user]);
    }

    public function newPasswordStore(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed'],
        ]);
        $user = User::find($request->id);
        if ($user->update([
            'password' => Hash::make($request->password),
        ])) {
            event(new Registered($user));
            Auth::login($user);
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}
