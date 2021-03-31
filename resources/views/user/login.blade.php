@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
    <div class="vh-100 p-5 d-flex align-items-center">
        <form action="{{ route('post.login') }}" method="POST" class="mx-auto text-center text-center shadow form-login">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h3>SignIn.</h3>
            <div class="d-flex align-items-center rounded-pill input-form">
                <i class="fas fa-envelope"></i>
                <input type="email" placeholder="Your email." name="email">
            </div>
            <div class="d-flex align-items-center rounded-pill input-form">
                <i class="fas fa-key"></i>
                <input type="password" placeholder="Your password." name="password">
            </div>
            <div class="d-flex justify-content-between px-3">
                <div class="d-flex align-items-center check-box">
                    <i class="fas fa-stop"></i>
                    <p class="m-0 px-2">Remember Me</p>
                    <input type="checkbox" name="remember" hidden>
                </div>
                <a href="">forget password</a>
            </div>
            @if ($errors->has('message'))
                <p class="m-0 pt-3">{{ $errors->first('message') }}</p>
            @endif
            <div class="d-flex align-items-center rounded-pill input-form input-submit">
                <input type="submit" value="login">
            </div>
            <p class="m-0 pb-2">or login using</p>
            <div class="icon-login-provider d-flex pb-2">
                <a href="{{ route('login.provider', ['provider' => 'facebook']) }}" class="col rounded-pill"><i class="fab fa-facebook-f"></i></a>
                <a href="{{ route('login.provider', ['provider' => 'google']) }}" class="col rounded-pill"><i class="fab fa-google"></i></a>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(".check-box").click(function() {
            if($('input[name="remember"]').is(':checked')) {
                $('input[name="remember"]').prop('checked', false);
                $(".check-box i").addClass('fa-stop');
                $(".check-box i").removeClass('fa-check-square');
            } else {
                $('input[name="remember"]').prop('checked', true);
                $(".check-box i").addClass('fa-check-square');
                $(".check-box i").removeClass('fa-stop');
            }
        });
    </script>
@endsection
