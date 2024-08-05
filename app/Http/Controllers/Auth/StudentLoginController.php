<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('student_id', 'birth_month', 'birth_day', 'birth_year', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication was successful
            return redirect('/userdashboard')->with('message', 'Login Successful');
        }

        // Authentication failed
        return back()->withErrors(['student_id' => 'Login Failed! Incorrect credentials'])->withInput($request->only('student_id'));
    }

    public function showLoginForm()
    {
        return view('user.login');
    }
}
