<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //Validate the request\
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Attemp to log in
        if(Auth::attempt($credentials, $request->boolean('remember'))){
            //Remember session for security
            $request->session()->regenerate();

            //Redirect to home page
            return redirect()->intended('/')->with('success', 'Welcome Back!');
        };

        //If log in fails, redirect back with error
        return back()
            ->withErrors(['email' => "The provided credentials do not match our records."])
            ->onlyInput('email');
    }
}
