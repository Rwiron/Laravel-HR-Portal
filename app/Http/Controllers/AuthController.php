<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function index (Request $request)
    {
        // echo "S";die(); -> if we browser it will return S as result output
        return view('login');
    }

    public function forgot_password (Request $request)
    {
        // echo "Forgot";
        // die();
        return view ('forgot_password');
    }

    public function register (Request $request)
    {
        // echo "register";
        // die();
        return view('register');
    }

    public function register_post (Request  $request)
    {
        // dd($request->all()); testing user reg in Array


        $user = request () ->validate([
            'name'   => 'required',
            'email'  => 'required|unique:users',
            'password'  => 'required|min:6',
            'confirm_Password'  => 'required_with:password|same:password|min:6'
        ]); 

        $user                 = new User;
        $user->name           = trim($request->name);
        $user->email          = trim($request->email);
        $user->password       = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->save();

        // for returning data that have been successfully registered

        return redirect('/')->with('success','Successfully Registered.');


    }

    public function Checkemail (Request $request)
    {
        $email = $request->input('email');
        $isExists = User::where('email', $email)->first();
        if($isExists) {
            return response()->json(array("exists" => true));
        }else {
            return response()->json(array("exists" => false));
        }

    }


    public function login_post(Request $request)
    {
        // dd($request->all());
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password],true))
        {
            if (Auth::User()->is_role =='1') {
                return redirect() -> intended('admin/dashboard');
            }
            else
            {
                return redirect('/')->with('error','No HR Available...Please Check Again');
            }
        }else
        {
            return redirect()->back()->with('error','Please enter correct credentials'); 
        }
    }
}

?>