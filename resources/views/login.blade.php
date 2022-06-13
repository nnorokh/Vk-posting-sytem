@extends('layout')

@section('title')
    Log in
@endsection

@section('link')
    <link rel="stylesheet" href="<?php echo asset('css/sign.css')?>">
@endsection

@section('main_section')
    <div class="container">
        <h1>Log in</h1>
        <form method="post" class="form">
            @csrf
            <input type="email" name="email" id="email" placeholder="Enter email"><br>
            <input type="password" name="password" id="password" placeholder="Enter password"><br>
            <button type="submit">Log in</button>
        </form>
        <h1 class="or">OR</h1>
        <div class="google">
            <a href="auth/google">
                <img src="<?php echo asset('images/google-icon.png')?>">
            </a>
        </div>
    </div>
@endsection
