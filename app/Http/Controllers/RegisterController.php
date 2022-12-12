<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function registerIndex()
    {

        if(Auth::user()){
            return redirect('/login');
        }
        return view('register');

    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $user = User::create(request(['name', 'email', 'password']));
        if ($user) {
            return redirect()->to('/login');
        }else{
            session()->flash('message', 'User not found');
            return Redirect()::back();
        }
        // return redirect()->to('/login');
    }
}
