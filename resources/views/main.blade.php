@extends('layout')

@section('title')
    Main Page
@endsection

@section('link')
    <link rel="stylesheet" href="<?php echo asset('css/main.css')?>">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,500;0,800;1,600&family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
@endsection

@section('main_section')
    <div class="container">
        <h1 class="title-post">Add new post</h1>
        <form action="" method="post" class="post_form">
            @csrf
            <label for="message">Message</label>
            <textarea type="text" name="message" id="message" class="message" placeholder="Hi, it's my first post over posting system"></textarea>
            <label for="attachments">Attachments link</label>
            <input type="text" name="attachments" id="attachments" class="attachments" placeholder="https://photo.png">
            <div class="socials">

                <div class="vk_div_checkbox" hidden>
                    <input type="checkbox" id="vk_checkbox" placeholder="hyi" name="vk_checkbox" checked hidden>
                    <label for="vk_checkbox" class="vk-label">
                        VK
                    </label>
                </div>

            </div>
            <button type="submit">Post</button>
        </form>
    </div>
@endsection
