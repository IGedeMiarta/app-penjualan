@extends('home.partials.app')
@section('content')
    <section class="container stylization maincont">


        <ul class="b-crumbs">
            <li>
                <a href="{{ url('/') }}">
                    Home
                </a>
            </li>
            <li>
                <span>Login</span>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Login</span></h1>
        <div class="auth-wrap" style="display: flex;justify-content: center">
            <div class="auth-col">
                <form method="post" class="login" action="">
                    @csrf
                    <p>
                        <label for="email">E-mail <span class="required">*</span></label><input type="email"
                            id="email" name="email">
                    </p>
                    <p>
                        <label for="password">Password <span class="required">*</span></label><input type="password"
                            id="password" name="password">
                    </p>
                    <p class="auth-submit">
                        <input type="submit" value="Login">
                        {{-- <input type="checkbox" id="rememberme" value="forever">
                        <label for="rememberme">Remember me</label> --}}
                    </p>
                    <div class="register">
                        <p class="auth-lost_password h5">Not have an account?
                            <a href="{{ url('register') }}">Register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>



    </section>
@endsection
