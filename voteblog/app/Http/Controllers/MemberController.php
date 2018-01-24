<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;

class MemberController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function login(Request $requests){
        $attempt = Auth::attempt([
            'name' => $requests['username'],
            'password' => $requests['password']
        ]);
        if ($attempt) {
            return Redirect::intended('about');
        }
        return Redirect::to('login')
                ->withErrors(['fail'=>'Username or password is wrong!']);
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('login');
    }

    public function register(){

    }
}
