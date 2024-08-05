<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FacultyLoginController extends Controller
{
    //

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication was successful, determine where to redirect the user
            $user = Auth::user();
        
            if ($user->hasAnyRole('superadmin', 'admin')) {
                // dd($user->getRoleNames());
                return redirect()->route('admin.dashboard')->with('message', 'Login Successful');
                
            } elseif ($user->hasRole('regular_user')) {
                return redirect('/userdashboard')->with('message', 'Login Successful');

            } elseif ($user->hasRole('nurse')) {

                return redirect()->route('nurseModule.dashboard')->with('message', 'Login Successful');

            } elseif ($user->hasRole('doctor')) {

                return redirect()->route('doctorModule.dashboard')->with('message', 'Login Successful');
            } 
            
            
            // return redirect('/userlogin')->with('message', 'Sorry! No record found');
            return back()->withErrors(['email' => 'Sorry! No record found']);
        }
        
        // Authentication failed
        return back()->withErrors(['email' => 'Login Failed! Incorrect credentials'])->withInput($request->only('email'));
    }
    public function showLoginForm()
    {
        return view('user.faculty_login');
    }
}
