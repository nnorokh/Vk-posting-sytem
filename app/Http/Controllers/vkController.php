<?php

namespace App\Http\Controllers;

use App\Models\socials;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use DB;
use phpDocumentor\Reflection\Type;

class vkController extends Controller
{
    function connect(){
        $accounts = socials::where('email', Cookie::get('auth'))->get()->toArray();
        return view('connect')->with('accounts', $accounts);
    }
    function connectPost(Request $request){
        $this->validate(request(), [
            'access_token' => 'required|min:5',
        ]);
        // First check( have user signed in )
        if(Cookie::get('auth')){
            //Second chek (does form have id)
            if($request->input('id')){
                //Third check (does user have db state)
                $finduser = socials::where('id', $request->input('id'))->first();
                if($finduser->email == Cookie::get('auth')){
                    //Just update access token
                    DB::update('update socials set vk_access_token = ? where id = ?', [$request->input('access_token'), $request->input('id')]);
                }else{
                    return view('login');
                }
                return redirect('/');
            }else{
                $user = new socials();

                $user->email = Cookie::get('auth');
                $user->vk_access_token = $request->input('access_token');

                $user->save();
                return redirect('/');
            }

        }else{
            // IF user have not signed in, redirect him to log-in form
            return redirect('login');
        }
    }

    //Temp func for vk posting
    function vkPost(Request $request){
        if($request->input('vk_checkbox')){

        $user = socials::where('email', Cookie::get('auth'))->get();
        $responses = [];
//        Post adding
        foreach($user as $account) {
            $from_group = $account->vk_from_group == 'on' ? 1 : 0;
            $owner_id = $account->vk_owner_id == 'user' ? null : $account->vk_owner_id;
            $response = Http::get('https://api.vk.com/method/wall.post', [
                'owner_id' => $owner_id,
                'from_group' => $from_group,
                'friends_only' => '0',
                'message' => $request->input('message'),
                'attachments' => $request->input('attachments'),
                'access_token' => $account->vk_access_token,
                'v' => '5.131',
            ]);
            $responses[] = $response->object()->response->post_id;
        }
//            Post link generating
            $ids = [];
        foreach ($user as $account){
            $user_id = '';
            if($account->vk_owner_id != 'user'){
                $user_id = $account->vk_owner_id;
            }else{
                $user_id = Http::get('https://api.vk.com/method/users.get', [
                    'access_token' => $account->vk_access_token,
                    'v' => '5.131',
                ])->object()->response[0]->id;
            }
            $id = $user_id.'_'.array_shift($responses);
            $ids[] = $id;
        }
        return view('successAdded', ['posts' => $ids]);

        }else{
            return redirect('login');
        }
        }

    function vkSetting(Request $request){
//        Updating
        $user = socials::where('email', Cookie::get('auth'))->first();

        if($user){
            if(!$request->input('owner_id')){

            }else{
                DB::update('update socials set vk_owner_id = ? where email = ?', [$request->input('owner_id'), Cookie::get('auth')]);
            }
            DB::update('update socials set vk_from_group = ? where email = ?', [$request->input('from_group'), Cookie::get('auth')]);

            return redirect('/');
        }else{
            return redirect('login');
        }
    }
}
