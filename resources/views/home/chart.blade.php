@extends('home.partials.app')
@push('style')
    <style>
        .disableBtn {
            pointer-events: none;
            cursor: default;

        }
    </style>
@endpush
@section('content')
    <section class="container stylization maincont">
        @include('home.partials.breadcubs')

        <h1 class="main-ttl"><span>Cart</span></h1>
        <!-- Cart Items - start -->
        <form action="{{ url('trasaction') }}" method="POST" id="cartForm">
            @csrf
            <div class="cart-items-wrap">
                <table class="cart-items">
                    <thead>
                        <tr>
                            <td class="cart-image">Photo</td>
                            <td class="cart-ttl">Products</td>
                            <td class="cart-price">Price</td>
                            <td class="cart-quantity">Quantity</td>
                            <td class="cart-summ">Summ</td>
                            <td class="cart-del">&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($chart as $crt)
                            <tr>
                                <td class="cart-image">
                                    <a href="{{ url('product/' . $crt->product->product_slug) }}">
                                        <img src="http://placehold.it/61x80" alt="Similique delectus totam">
                                    </a>
                                </td>
                                <td class="cart-ttl">
                                    <a
                                        href="{{ url('product/' . $crt->product->product_slug) }}">{{ $crt->product->product_name }}</a>
                                    <p><b>Category: </b>{{ $crt->product->category->category_name }}</p>
                                    <p><b>Auhtor: </b>{{ $crt->product->author->name }}</p>
                                    <input type="hidden" name="product[]" value="{{ $crt->product->id }}">
                                </td>
                                <td class="cart-price">
                                    <b>{{ nb($crt->price) }}</b>
                                    <input type="hidden" name="price[]" value="{{ $crt->price }}">

                                </td>
                                <td class="cart-quantity">
                                    <p class="cart-qnt">
                                        <b>{{ $crt->qty }}</b>
                                        <input type="hidden" name="qty[]" value="{{ $crt->qty }}">

                                    </p>
                                </td>
                                <td class="cart-summ">
                                    <b>{{ nb($crt->price * $crt->qty) }}</b>
                                    <p class="cart-forone">unit price <b>{{ nb($crt->price) }}</b></p>
                                    <input type="hidden" name="total[]" value="{{ $crt->price * $crt->qty }}">
                                </td>
                                <td class="cart-del">
                                    <a href="{{ url('chart-del/' . $crt->id) }}" class="cart-remove"></a>
                                </td>
                            </tr>
                            @php
                                $total += $crt->price * $crt->qty;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <ul class="cart-total">
                <li class="cart-summ">TOTAL: <b>{{ nb($total) }}</b></li>
                <input type="hidden" name="amount" value="{{ $total }}">
            </ul>
            <div class="cart-submit">
                <div class="cart-coupon">
                    <input placeholder="your coupon" type="text">
                    <a class="cart-coupon-btn" href="#"><img src="{{ asset('assets') }}/img/ok.png"
                            alt="your coupon"></a>
                </div>
                <a href="#" class="cart-submit-btn" onclick="submitForm()"
                    style="@if ($total <= 0) background-color: #9EB8D9; @else background-color: #2B3499; @endif">Checkout</a>
                {{-- <button type="submit" class="cart-submit-btn" target="_blank"
                    style="@if ($total <= 0) background-color: #9EB8D9; @else background-color: #2B3499; @endif">Checkout</button> --}}
                <a href="{{ url('chart-del-all') }}" class="cart-submit-btn"
                    style="@if ($total <= 0) background-color: #FFC5C5; pointer-events: none; @else background-color: #C70039 ; @endif">Clear
                    cart</a>
            </div>
        </form>
        <!-- Cart Items - end -->

    </section>
@endsection
@push('script')
    <script>
        function submitForm() {
            // Submit the form
            document.getElementById('cartForm').submit();
        }
    </script>
@endpush
