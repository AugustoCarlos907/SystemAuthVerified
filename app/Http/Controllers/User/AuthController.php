<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Registro
    public function showRegisterForm(){
        return view('user.register');
    }
    public function register(StoreUserRequest $request){
        $credentials = $request->validated();
        try {
            if($credentials){
                $user = User::create([
                    'name' => $credentials['name'],
                    'email' => $credentials['email'],
                    'password' => Hash::make($credentials['password']),
                    // 'password_confirmation' => Hash::make($credentials['password_confirmation']),
                ]);

                // Dispara email de verificação
                event(new Registered($user));

                Auth::guard('user')->login($user);
                return redirect()->route('verification.notice');
            }
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Registration failed: ' . $e->getMessage(),
            ])->onlyInput('email');
        }
    }

    //Verificação de email
    public function showVerificationNotice(){
        if (Auth::guard('user')->user()->hasVerifiedEmail()) {
            return redirect()->route('user.dashboard');
        }

        return view('auth.verify-email') ;
    }

    public function verifyEmail(EmailVerificationRequest $request ){
        $request->fulfill();
        return redirect()->route('user.dashboard');
    }

    public function sendEmailVerification (){
        Auth::guard('user')->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    //login & logout
    public function showLoginForm(){
        return view('user.login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('user')->attempt($credentials)) {
                $request->session()->regenerate();

                $user = Auth::guard('user')->user();

                if (!$user->hasVerifiedEmail()) {
                    return redirect()->route('verification.notice');
                }

        return redirect()->route('user.dashboard');
    }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::guard('user')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }
}
