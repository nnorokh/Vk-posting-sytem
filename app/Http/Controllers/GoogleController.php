<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\usersSimple;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cookie;
class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = usersSimple::where('google_id', $user->id)->first();

            if($finduser){

                $auth = Cookie::make('auth', $finduser->email, 60);
                return redirect()->intended('/')->withCookie($auth);

            }else{
                $newUser = usersSimple::create([
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
                $newUser->save();
                $auth = Cookie::make('auth', $newUser->email, 60);
                return redirect()->intended('/')->withCookie($auth);
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
