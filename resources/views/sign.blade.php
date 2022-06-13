@extends('layout')

@section('title')
    Sign in
@endsection

@section('link')
    <link rel="stylesheet" href="<?php echo asset('css/sign.css')?>">
@endsection

@section('main_section')
    <div class="container">
        <h1>Sign up</h1>
        <form method="post" class="form">
            @csrf
            <input type="email" name="email" id="email" placeholder="Enter email"><br>
            @if($errors->has('email'))
                <div class="error"><p class="p-in-error">{{ $errors->first('email') }}</p></div>
            @endif
            <input type="password" name="password" id="password" placeholder="Enter password"><br>
            @if($errors->has('password'))
                <div class="error"><p class="p-in-error">{{ $errors->first('password') }}</p></div>
            @endif
            <button type="submit">SIGN UP</button>
        </form>
        <h1 class="or">OR</h1>
        <div class="google">
            <a href="auth/google">
                <img src="<?php echo asset('images/google-icon.png')?>">
            </a>
        </div>
    </div>
@endsection
