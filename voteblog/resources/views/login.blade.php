@extends('layouts.master')

@section('title', '登入頁面')

@section('content')

@if($register)
    @include('forms/registerform')
@else
    @include('forms/loginform')
@endif

@endsection