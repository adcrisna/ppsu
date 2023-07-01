<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function prosesLogin(Request $request)
    {  
        if (Auth::attempt(['username'=>$request->username,'password'=>$request->password]))
        {
            if (Auth::User()->role == "1")
            {
                return \Redirect::to('/admin/home');
            }
            elseif (Auth::User()->role == "2") {
                return \Redirect::to('/koordinator/home');
            }elseif (Auth::User()->role == "3") {
                return \Redirect::to('/lurah/home');
            }else{
                \Session::flash('msg_login','Username Atau Password Salah!');
                return \Redirect::to('/');
            }

        }
        else
        {
            \Session::flash('msg_login','Username Atau Password Salah!');
            return \Redirect::to('/');
        }
    }
    public function logout(){
        Auth::logout();
      return \Redirect::to('/');
    }
}
