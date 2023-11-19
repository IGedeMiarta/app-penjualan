@extends('home.partials.app')
@section('content')
    <section class="container stylization maincont">
        @include('home.partials.breadcubs')
        <hr>
        <div class="row" style="margin-top: 10px">
            <div class="col-md-5">
                <h1 class="main-ttl"><span>{{ 'USER ACCOUNT' }}</span></h1>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Enter Name" name="name"
                            value="{{ $user->name }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Enter Email" name="email"
                            value="{{ $user->email }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <form action="{{ url('/logout') }}" id="form" method="POST">
                    @csrf
                    <div class="cart-submit">
                        <a href="#" class="cart-submit-btn" style="background-color: #FA7070" onclick="submitForm()">
                            LOGOUT</a>
                    </div>
                </form>
            </div>
            <div class="col-md-7">
                <h1 class="main-ttl"><span>{{ 'Order History' }}</span></h1>

                <div class="cart-items-wrap">
                    <table class="cart-items">
                        <thead>
                            <tr>
                                <td class="cart-ttl">Products</td>
                                <td class="cart-quantity">Qty</td>
                                <td class="cart-price">Price</td>
                                <td class="cart-summ">Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($table as $item)
                                <tr>

                                    <td class="cart-ttl">
                                        <a href="{{ url('invoice/' . $item->Invoice) }}" target="_blank"
                                            style="color: #7071E8">#{{ $item->Invoice }}</a>

                                        @foreach ($item->details as $i => $d)
                                            <p>{{ $i + 1 . '. ' . $d->product->product_name }}</p>
                                        @endforeach

                                    </td>
                                    <td class="cart-quantity">
                                        <p class="cart-qnt">{{ $item->details->count() }}</p>
                                    </td>
                                    <td class="cart-price">
                                        <b>{{ nb($item->amount) }}</b>
                                    </td>

                                    <td class="cart-summ">
                                        <b>{!! $item->status() !!}</b>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="4">
                                    <b>
                                        <center>
                                            No orders yet!
                                        </center>
                                    </b>
                                </td>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
@endsection
@push('script')
    <script>
        function submitForm() {
            // Submit the form
            document.getElementById('form').submit();
        }
    </script>
@endpush
