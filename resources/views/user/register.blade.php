@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
    <div class="vh-100 p-5 d-flex align-items-center">
        <form action="{{ route('post.register') }}" method="POST" class="mx-auto text-center text-center shadow form-login">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h3>SignUp.</h3>
            {{-- <div class="d-flex">
                <div class="d-flex align-items-center rounded-pill input-form my-0">
                    <i class="fas fa-user-tie"></i>
                    <input type="text" placeholder="firstname." name="firstname">
                </div>
                <div class="d-flex align-items-center rounded-pill input-form my-0">
                    <i class="fas fa-user-tie"></i>
                    <input type="text" placeholder="lastname." name="lastname">
                </div>
            </div> --}}
            <div class="d-flex align-items-center rounded-pill input-form">
                <i class="fas fa-user-tie"></i>
                <input type="text" placeholder="your name." name="name">
            </div>
            <div class="d-flex align-items-center rounded-pill input-form">
                <i class="fas fa-envelope"></i>
                <input type="email" placeholder="your email." name="email" required>
            </div>
            <div class="d-flex align-items-center rounded-pill input-form">
                <i class="fas fa-key"></i>
                <input type="password" placeholder="your password." name="password" required>
            </div>
            @if ($errors->has('message'))
                <p class="m-0 p-1">{{ $errors->first('message') }}</p>
            @endif
            <div class="d-flex align-items-center rounded-pill input-form input-submit">
                <input type="submit" value="register">
            </div>
            <a href="{{ route('login') }}" class="m-0">or login</a>
        </form>
    </div>
@endsection
@section('script')
    
@endsection
