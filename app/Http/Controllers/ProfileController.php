<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use App\Models\Profile;


class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function getData(Request $request)
    { 
        $auth = Auth::user();
        return response()->json($auth);
    }

    public function updatePassword(Request $request, $id)
    {
        $result = [
            'status' => false,
            'message' => 'oke',
            'data' => '',
            'newToken' => csrf_token(),
        ];

        // $au;
        $user = Profile::find($request->id);

        if (!Hash::check($request->old_password, $user->password)) {
            $result['message'] = 'Old Password Wrong';
            return response()->json($result);
        }
        if ($request->new_password != $request->confirm_password) {
            $result['message'] = 'new password and confirm password not match';
            return response()->json($result);
        }

        $user->password = Hash::make($request->new_password);
        $user->update();

        $result['message'] = 'Success update password';
        $result['status'] = true;
        $result['data'] = $user;
        return response()->json($result);
        // return redirect('/user/logout');

}

public function updateProfile(Request $request, $id){
        
    $result = [
        'status'=> false,
        'data' => null,
        'message'=> '',
        'newToken' => csrf_token()
    ];
    
    $user = Profile::where('name', $request->name)->where('id','!=', $id)->first();
    if($user){
        $result['message']='Data user already exist';
        return response()->json($result);
    }

    $user= Profile::where('id', $id)->first();
    if(!$user){
        $result['message'] = "user not found";
        return response()->json($result);
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->update();

    $result['status'] = true;
    $result['data']= $user;
    $result['message']= "Success update data";
    return response()->json($result);
    
}

}