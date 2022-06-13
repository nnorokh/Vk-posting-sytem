@extends('layout')

@section('title')
    Added page
@endsection

@section('link')
    <link rel="stylesheet" href="<?php echo asset('css/successAdded.css')?>">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,500;0,800;1,600&family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
@endsection

@section('main_section')
    <div class="container">
        <h1>Succesfully added</h1>
        <p>Link's: </p>
        @foreach($posts as $post)
            <div class="post">
                <a href="https://vk.com/feed?w=wall{{$post}}">{{$post}}</a>
            </div>
       @endforeach
    </div>
@endsection
