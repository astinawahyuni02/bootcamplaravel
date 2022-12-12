<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import model user
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function loginIndex()
    {
        if(Auth::user()){
            return redirect('/dashboard');
        }
        return view('login');
        // public ini berfungsi agar ketika keluar dashboard tidak perlu login lagi
    }

    public function login(Request $request)
    {
        // request digunakan untuk variabel
        $user = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if ($user) {
            return redirect()->to('/dashboard');
        } else {
            session()->flash('message', 'User not found');
            return Redirect::back();
        }
    }
}
