@extends('layouts.master')

@section('title', 'Avery')

@section('content')

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