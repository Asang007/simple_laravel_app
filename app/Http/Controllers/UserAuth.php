<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserAuth extends Controller
{
    public function homePage(){
        if (isset(Auth::user()->email)) {
            $user_data = User::with('userRole')->get();
            return view('dashboard', compact('user_data'));
        } else {
            return view('login');
        }
    }

    public function signIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:3',
        ]);

        $user_login_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        );

        if (Auth::attempt($user_login_data)) {
            return redirect('/');
        } else {
            return back()->with('error', 'Wrong Login Details');
        }
    }

    public function signOut(){
        Auth::logout();
        return redirect('/');
    }
}
