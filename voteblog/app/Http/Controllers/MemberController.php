<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use App\User;

class MemberController extends Controller
{
    //
    public function get_login()
    {
        return view('login')->with('register', False);
    }

    public function post_login(Request $requests){
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

    public function get_logout(){
        Auth::logout();
        return Redirect::to('login');
    }

    public function get_register(){
        return view('login')->with('register', True);
    }

    public function post_register(Request $requests){
        $validator = Validator::make($requests->all(),[
            'username' => 'unique:users,name',
            'email' => 'unique:users,email',
        ]);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput(Input::except('password'));
        }
        $this->create($requests);
        return Redirect::intended('about');
    }

    public function create(Request $request)
    {
        $user = new User;
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
    }
}
