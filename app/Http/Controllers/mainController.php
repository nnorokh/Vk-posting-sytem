<?php

namespace App\Http\Controllers;

use App\Models\usersSimple;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class mainController extends Controller
{
    function sign(){
        return view('sign');
    }
    function login(){
        return view('login');
    }
    function signPost(Request $request){
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|min:5',

        ]);

        $finduser = usersSimple::where('email', $request->input('email'))->first();
        if($finduser && $finduser->spare_id == null){
            error_log('finduser, spare_id = null');
            DB::update('update users_simples set password = ? where email = ?', [Hash::make($request->input('password')), $request->input('email')]);
            DB::update('update users_simples set spare_id = ? where email = ?', [Hash::make($request->input('email')), $request->input('email')]);

            $auth = Cookie::make('auth', $finduser->email, 60);
            return redirect()->intended('/')->withCookie($auth);
        }else if($finduser) {
            error_log('user found, need password');
            if(Hash::check($request->input('password'), $finduser->password)){
                $auth = Cookie::make('auth', $finduser->email, 60);
                return redirect()->intended('/')->withCookie($auth);
            }else{
                return back()->withErrors(['password' => "The password is incorrect"]);
            }
        }else{
            error_log('else');
        $user = new usersSimple();

        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->spare_id = Hash::make($request->input('email'));

        $user->save();

        $auth = Cookie::make('auth', $user->email, 60);
        return redirect()->intended('/')->withCookie($auth);
        }
    }
    function index()
    {
        return view('main');
    }
    function signout(){
        $auth = Cookie::forget('auth');
        return redirect('/')->withCookie($auth);
    }

}
