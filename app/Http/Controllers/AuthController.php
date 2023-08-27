<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        return view('login.main', [
            'layout' => 'login'
        ]);
    }

    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
       

        if (!\Auth::attempt([
            'userName' => $request->userName,
            'password' => $request->password
        ])) {
            $this->dispatchBrowserEvent('noty', ['msg' => 'Wrong email or password.']);

            // throw new \Exception('Wrong email or password.');
        }else{
            dd('ingreso');

        }

    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        \Auth::logout();
        return redirect('login');
    }

    public function register(){
        return view('login.register', [
            'layout' => 'login'
        ]);
    }
}
