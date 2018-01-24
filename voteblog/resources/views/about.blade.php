@extends('layouts.master')

@section('title', 'Avery')

@section('content')

@if(Auth::check())
    <form action='/about' method="POST">
        {{csrf_field()}}
        <input type="text" placeholder="Route" name="route">
        <input type="text" placeholder="Title" name="title">
        <input type="text" placeholder="Content" name="content">
        <input type="submit">
    </form>
@endif

<div class="container">
    <div class="row">
        @include('layouts.about_sidebar')
        <div class="col-md-12 col-offset-100">
            <?php 
                $content = 'Page note found';
            ?>
            @foreach ($abouts as $about)
                @if ($about->route == $subpage)
                    <?php
                        $content = $about->content;
                    ?>
                    @break
                @endif
            @endforeach
            {{$content}}
        </div>
    </div>    
</div>

@endsection