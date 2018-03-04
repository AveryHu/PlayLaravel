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
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getLogin()
    {
        $register = false;

        return view('login', compact('register'));
    }

    public function postLogin(Request $request)
    {
        // 可以改成 name 就可以直接使用了
        $params = $request->only(['name', 'password']);

        if (auth()->attempt($params)) {
            return redirect()->intended('about');
        }

        return redirect()->to('login')->withErrors([
            'fail' => 'Username or password is wrong!'
        ]);
    }

    public function getLogout()
    {
        auth()->logout();

        return redirect()->to('login');
    }

    public function getRegister()
    {
        $register = true;

        return view('login', compact('register'));
    }

    public function postRegister(Request $request)
    {
        $params = $request->only(['username', 'email', 'password']);

        $validator = Validator::make(
            $params, [
                'username' => 'unique:users,name',
                'email' => 'unique:users,email'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->except(['password']));
        }
        $params['password'] = Bcrypt($params['password']);
        $this->user->create($params);
        return redirect()->intended('about');
    }
}
