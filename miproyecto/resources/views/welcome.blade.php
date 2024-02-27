@extends('layouts.app')

@vite(['resources/css/app.css'])
@vite(['resources/js/welcome.js'])

@section('content')
  <div class="welcome d-flex align-items-center justify-content-center">
    <div class="text-center">
      <h1 class="text-white" >Store Your Contacts Now</h1>
      <a class="btn btn-lg btn-dark" href="{{route('register')}}">Get Started</a>
    </div>
  </div>
@endsection


