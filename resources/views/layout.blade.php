<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo asset('css/layout.css')?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,500;0,800;1,600&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,500;0,800;1,600&family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <title> @yield('title') </title>
    @yield('link')
</head>
<body>
{{--Header--}}
    <div class="top-menu">
            <a href="/" class="title">VK-posting system</a>
        <div class="links">
            <a href="#">How it work?</a>
            <a href="connect">Add accounts</a>
        </div>
        @if(\Illuminate\Support\Facades\Cookie::has('auth'))
            <div class="login">
                <a href="/sign-out">Sign out</a>
                <a href="connect">Profile</a>
            </div>
        @else
        <div class="login">
            <a href="/login">Log in</a>
            <a href="/sign">Sign in</a>
        </div>
        @endif
    </div>
    @yield('main_section')
</body>
</html>
