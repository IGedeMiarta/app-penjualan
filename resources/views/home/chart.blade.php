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
                <span>Cart</span>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Cart</span></h1>
        <!-- Cart Items - start -->
        <form action="#">

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
                                    <a href="product.html">
                                        <img src="http://placehold.it/61x80" alt="Similique delectus totam">
                                    </a>
                                </td>
                                <td class="cart-ttl">
                                    <a href="product.html">{{ $crt->product->product_name }}</a>
                                    <p><b>Category: </b>{{ $crt->product->category->category_name }}</p>
                                    <p><b>Auhtor: </b>{{ $crt->product->author->name }}</p>
                                </td>
                                <td class="cart-price">
                                    <b>{{ nb($crt->price) }}</b>
                                </td>
                                <td class="cart-quantity">
                                    <p class="cart-qnt">
                                        <b>{{ $crt->qty }}</b>
                                    </p>
                                </td>
                                <td class="cart-summ">
                                    <b>{{ nb($crt->price * $crt->qty) }}</b>
                                    <p class="cart-forone">unit price <b>{{ nb($crt->price) }}</b></p>
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
            </ul>
            <div class="cart-submit">
                <div class="cart-coupon">
                    <input placeholder="your coupon" type="text">
                    <a class="cart-coupon-btn" href="#"><img src="{{ asset('assets') }}/img/ok.png"
                            alt="your coupon"></a>
                </div>
                <a href="#" class="cart-submit-btn" style="background-color: #7C93C3">Checkout</a>
                <a href="{{ url('chart-del-all') }}" class="cart-submit-btn" style="background-color: #A25772">Clear
                    cart</a>
            </div>
        </form>
        <!-- Cart Items - end -->

    </section>
@endsection
