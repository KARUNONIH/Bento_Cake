<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login()
    {
        $data['title'] = 'Login';
        return view('admin.login', $data);
    }

    public function login_action(Request $request)
    {

        if(Auth::attempt(['username' => $request->username , 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->route('admin.index');

        }
        return back()->withErrors('password', 'Wrong username or password!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
