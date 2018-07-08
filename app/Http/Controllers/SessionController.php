<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        //return view('sessions.create');
        return view('auth.login');
    }

    public function store()
    {
        //$req = ['email' => request('email'), 'password' => bcrypt(request('password'))];
        $req = ['email' => request('email'), 'password' => request('password')];

        if (auth()->attempt($req) == false) {

            return back()->withErrors([

                'message' => 'The email or password is incorrect, please try again'
            ]);
        }

        return redirect()->to('/personal/profile');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->to('/home');
    }
}
