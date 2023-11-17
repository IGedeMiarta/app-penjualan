@extends('home.partials.app')
@section('content')
    <!-- Main Content - start -->
    <main>
        <section class="container">
            {{-- <ul class="b-crumbs">
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>
                    <a href="catalog-list.html">
                        Catalog
                    </a>
                </li>
                <li>
                    <a href="catalog-list.html">
                        Women
                    </a>
                </li>
                <li>
                    <span>{{ $product->product_name }}</span>
                </li>
            </ul> --}}
            <!-- Single Product - start -->
            <div class="prod-wrap">

                <!-- Product Images -->
                <div class="prod-slider-wrap">
                    <div class="prod-slider">
                        <ul class="prod-slider-car">
                            @foreach ($images as $item)
                                <li class="float: left; list-style: none; position: relative; width: 464px;">
                                    <a data-fancybox-group="popup-product" class="fancy-img" href="{{ url($item->file) }}"
                                        target="_blank">
                                        <img src="{{ url($item->file) }}" alt="{{ $item->slug }}">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="prod-thumbs">
                        <ul class="prod-thumbs-car">

                            @foreach ($images as $i => $img)
                                <li>
                                    <a data-slide-index="{{ $i }}" href="#">
                                        <img src="{{ url($img->file) }}" alt="">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Product Description/Info -->
                <div class="prod-cont">
                    <h1 class="main-ttl"><span>{{ $product->product_name }}</span></h1>
                    <div class="prod-info">
                        <p class="prod-skuttl">Author</p>
                        <a href="{{ url('author/' . $product->author_id) }}">
                            <h3 class="item_current_price text-info">
                                {{ $product->author->name }}</h3>
                        </a>

                    </div>
                    <div class="prod-skuwrap">
                        <p class="prod-skuttl">Tags</p>
                        <ul class="prod-skucolor">
                            {!! $product->tags() !!}

                        </ul>
                    </div>
                    <div class="prod-info">

                        <p class="prod-price">
                            @if ($disc)
                                <del>{{ nb($disc) }}</del>
                            @endif
                            <b class="item_current_price text-info">
                                {{ nb($price) }}</b>
                        </p>
                        <p class="prod-addwrap">
                            <a href="{{ url('chart-add?_xcode=' . $price * 111111 . '&product=' . $product->product_slug) }}"
                                class="prod-add" rel="nofollow">Add to cart</a>
                        </p>
                    </div>
                    <ul class="prod-info">
                        <p>{!! $details !!}</p>
                    </ul>
                </div>

                {{-- review product here --}}
                {{-- @include('home.product.reviews') --}}
                {{-- end product here --}}

            </div>

            {{-- related product here --}}
            @include('home.partials.related')
            {{-- end product related --}}


        </section>
    </main>
    <!-- Main Content - end -->
@endsection
