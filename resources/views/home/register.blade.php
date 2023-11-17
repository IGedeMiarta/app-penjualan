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
                <span>Registration</span>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Registration</span></h1>
        <div class="row"style="display: flex;justify-content: center">

            <div class="col-md-6">
                <form method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Name<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Enter Name"
                                name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Enter Email"
                                name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Enter Password"
                                name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Retype Password<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Retype Password"
                                id="password_confirmation" name="password_confirmation">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



    </section>
@endsection
