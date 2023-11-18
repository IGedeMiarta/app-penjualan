@extends('home.partials.app')
@section('content')
    <section class="container">
        @include('home.main.slider')

        @include('home.main.populars')


        @include('home.main.banner')


        @include('home.main.special')

        @include('home.main.testimoni')

    </section>
@endsection
