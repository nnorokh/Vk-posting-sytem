@extends('layout')


@section('tittle')
    Connect
@endsection

@section('link')
    <link rel="stylesheet" href="<?php echo asset('css/connect.css')?>">
@endsection



@section("main_section")
   <div class="container">
       @foreach($accounts as $account)
           <div class="vk">
               {{--            <img src="<?php echo asset('images/vk-icon.png')?>">--}}
               <h1 class="vk-logo">{{$account['id']}}</h1>
               <form action="" method="post" class="vk_access_token">
                   @csrf
                   <input type="text" name="id" id="id" value="{{$account['id']}}" hidden>
                   <input type="text" name="access_token" id="access_token" placeholder="Access token" value="{{$account['vk_access_token']}}">
                   <button type="submit">Save</button>
               </form>
               <a href="https://oauth.vk.com/authorize?client_id=8183146&display=page&redirect_uri=https://oauth.vk.com/blank.html/connect&scope=wall,status,offline&response_type=token&v=5.131&state=123456&revoke=1" class="vk_a">Get token</a>
               <div class="vk_post_setting">
                   <form action="vk-setting" method="post">
                       @csrf
                   <input type="text" name="id" id="id" value="{{$account['id']}}" hidden>
                       <input type="number" name="owner_id" id="owner_id" placeholder="Owner id (by default user wall)" value="{{$account['vk_owner_id']}}">
                       <input type="checkbox" name="from_group" id="from_group" checked>
                       <label for="from_group">Publish from group name</label>
                       <button type="submit">Save changes</button>
                   </form>
               </div>
           </div>
       @endforeach
       <h1 class="newAccountTitle">Add new account</h1>
        <div class="vk difcol">
{{--            <img src="<?php echo asset('images/vk-icon.png')?>">--}}
            <h1 class="vk-logo">VK</h1>
            <form action="" method="post" class="vk_access_token">
                @csrf
                <input type="text" name="access_token" id="access_token" placeholder="Access token">
                <button type="submit">Save</button>
            </form>
            <a href="https://oauth.vk.com/authorize?client_id=8183146&display=page&redirect_uri=https://oauth.vk.com/blank.html/connect&scope=wall,status,offline&response_type=token&v=5.131&state=123456&revoke=1" class="vk_a">Get token</a>
            <div class="vk_post_setting">
                <form action="vk-setting" method="post">
                     @csrf
                    <input type="number" name="owner_id" id="owner_id" placeholder="Owner id (by default user wall)">
                    <input type="checkbox" name="from_group" id="from_group">
                    <label for="from_group">Publish from group name</label>
                    <button type="submit">Save changes</button>
                </form>
            </div>
        </div>
   </div>
@endsection
