<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //Registro
    public function showRegisterForm(){
        return view('user.register');
    }
    public function register(StoreUserRequest $request){
        try {
            $credentials = $request->validated();

            if($credentials){
                $user = User::create($credentials);

                // Dispara email de verificação
                event(new Registered($user));

                Auth()->guard('user')->login($user);
                return redirect()->route('verification.notice');
        }
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Registration failed. Please try again.',
            ])->onlyInput('email');
        }
    }

    //Verificação de email
    public function showVerificationNotice(){
        return view('user.verify-email');
    }

    public function verifyEmail(EmailVerificationRequest $request ){
        $request->fulfill();
        return redirect()->route('user.dashboard');
    }

    public function sendEmailVerification (Request $request){
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    //login & logout
    public function showLoginForm(){
        return view('user.login');
    }
    public function login(StoreUserRequest $request){
        $credentials = $request->validated();

        if(Auth()->guard('user')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(){
        Auth()->guard('user')->logout();
        return redirect()->route('user.login');
    }
}
