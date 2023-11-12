<!-- Popular Products -->
<div class="fr-pop-wrap">

    <h3 class="component-ttl"><span>Popular products</span></h3>

    <ul class="fr-pop-tabs sections-show">
        <li><a data-frpoptab-num="1" data-frpoptab="#all" href="#" class="active">All
                Categories</a></li>
        @foreach ($category_all as $i => $item)
            <li><a data-frpoptab-num="{{ $i + 1 }}" data-frpoptab="#{{ $item->category_slug }}"
                    href="#">{{ $item->category_name }}</a></li>
        @endforeach
    </ul>

    <div class="fr-pop-tab-cont">

        <p data-frpoptab-num="1" class="fr-pop-tab-mob active" data-frpoptab="#all">All
            Categories</p>
        <div class="flexslider prod-items fr-pop-tab" id="all">
            <ul class="slides">
                @foreach ($product_all as $pal)
                    <li class="prod-i">
                        <div class="prod-i-top">
                            <a href="product.html" class="prod-i-img"><!-- NO SPACE --><img
                                    src="http://placehold.it/250x350"
                                    alt="Aspernatur excepturi rem"><!-- NO SPACE --></a>
                            <p class="prod-i-info">
                                <a href="#" class="prod-i-favorites"><span>Wishlist</span><i
                                        class="fa fa-heart"></i></a>
                                <a href="#" class="qview-btn prod-i-qview"><span>Quick View</span><i
                                        class="fa fa-search"></i></a>
                                <a class="prod-i-compare" href="#"><span>Compare</span><i
                                        class="fa fa-bar-chart"></i></a>
                            </p>
                            <p class="prod-i-addwrap">
                                <a href="#" class="prod-i-add">Go to detail</a>
                            </p>
                        </div>
                        <h3>
                            <a href="product.html">{{ $pal->product_name }}</a>
                        </h3>
                        <p class="prod-i-price">
                            <b class="text-success">{{ 'Rp ' . number_format($pal->price, 0, '.', ',') }}</b>
                        </p>
                    </li>
                @endforeach
            </ul>

        </div>
        @foreach ($category_all as $i => $item)
            <p data-frpoptab-num="2" class="fr-pop-tab-mob" data-frpoptab="#{{ $item->category_slug }}">
                {{ $item->category_name }}
            </p>
            <div class="flexslider prod-items fr-pop-tab" id="{{ $item->category_slug }}">
                @php
                    $product = App\Models\Product::where('id_categories', $item->id)->get();
                @endphp
                <ul class="slides">
                    @foreach ($product as $p)
                        <li class="prod-i">
                            <div class="prod-i-top">
                                <a href="product.html" class="prod-i-img"><!-- NO SPACE --><img
                                        src="http://placehold.it/250x350"
                                        alt="Aspernatur excepturi rem"><!-- NO SPACE --></a>
                                <p class="prod-i-info">
                                    <a href="#" class="prod-i-favorites"><span>Wishlist</span><i
                                            class="fa fa-heart"></i></a>
                                    <a href="#" class="qview-btn prod-i-qview"><span>Quick View</span><i
                                            class="fa fa-search"></i></a>
                                    <a class="prod-i-compare" href="#"><span>Compare</span><i
                                            class="fa fa-bar-chart"></i></a>
                                </p>
                                <p class="prod-i-addwrap">
                                    <a href="#" class="prod-i-add">Go to detail</a>
                                </p>
                            </div>
                            <h3>
                                <a href="product.html">{{ $p->product_name }}</a>
                            </h3>
                            <p class="prod-i-price">
                                <b class="text-success">{{ 'Rp ' . number_format($p->price, 0, '.', ',') }}</b>
                            </p>
                        </li>
                    @endforeach

                </ul>
            </div>
        @endforeach



    </div><!-- .fr-pop-tab-cont -->


</div><!-- .fr-pop-wrap -->


<!-- Quick View Product - start -->
<div class="qview-modal">
    <div class="prod-wrap">
        <a href="product.html">
            <h1 class="main-ttl">
                <span>Reprehenderit adipisci</span>
            </h1>
        </a>
        <div class="prod-slider-wrap">
            <div class="prod-slider">
                <ul class="prod-slider-car">
                    <li>
                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x525">
                            <img src="http://placehold.it/500x525" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x591">
                            <img src="http://placehold.it/500x591" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x525">
                            <img src="http://placehold.it/500x525" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x722">
                            <img src="http://placehold.it/500x722" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x722">
                            <img src="http://placehold.it/500x722" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x722">
                            <img src="http://placehold.it/500x722" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x722">
                            <img src="http://placehold.it/500x722" alt="">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="prod-thumbs">
                <ul class="prod-thumbs-car">
                    <li>
                        <a data-slide-index="0" href="#">
                            <img src="http://placehold.it/500x525" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-slide-index="1" href="#">
                            <img src="http://placehold.it/500x591" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-slide-index="2" href="#">
                            <img src="http://placehold.it/500x525" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-slide-index="3" href="#">
                            <img src="http://placehold.it/500x722" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-slide-index="4" href="#">
                            <img src="http://placehold.it/500x722" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-slide-index="5" href="#">
                            <img src="http://placehold.it/500x722" alt="">
                        </a>
                    </li>
                    <li>
                        <a data-slide-index="6" href="#">
                            <img src="http://placehold.it/500x722" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="prod-cont">
            <p class="prod-actions">
                <a href="#" class="prod-favorites"><i class="fa fa-heart"></i> Add to Wishlist</a>
                <a href="#" class="prod-compare"><i class="fa fa-bar-chart"></i> Compare</a>
            </p>
            <div class="prod-skuwrap">
                <p class="prod-skuttl">Color</p>
                <ul class="prod-skucolor">
                    <li class="active">
                        <img src="img/color/blue.jpg" alt="">
                    </li>
                    <li>
                        <img src="img/color/red.jpg" alt="">
                    </li>
                    <li>
                        <img src="img/color/green.jpg" alt="">
                    </li>
                    <li>
                        <img src="img/color/yellow.jpg" alt="">
                    </li>
                    <li>
                        <img src="img/color/purple.jpg" alt="">
                    </li>
                </ul>
                <p class="prod-skuttl">Sizes</p>
                <div class="offer-props-select">
                    <p>XL</p>
                    <ul>
                        <li><a href="#">XS</a></li>
                        <li><a href="#">S</a></li>
                        <li><a href="#">M</a></li>
                        <li class="active"><a href="#">XL</a></li>
                        <li><a href="#">L</a></li>
                        <li><a href="#">4XL</a></li>
                        <li><a href="#">XXL</a></li>
                    </ul>
                </div>
            </div>
            <div class="prod-info">
                <p class="prod-price">
                    <b class="item_current_price">$238</b>
                </p>
                <p class="prod-qnt">
                    <input type="text" value="1">
                    <a href="#" class="prod-plus"><i class="fa fa-angle-up"></i></a>
                    <a href="#" class="prod-minus"><i class="fa fa-angle-down"></i></a>
                </p>
                <p class="prod-addwrap">
                    <a href="#" class="prod-add">Add to cart</a>
                </p>
            </div>
            <ul class="prod-i-props">
                <li>
                    <b>SKU</b> 05464207
                </li>
                <li>
                    <b>Manufacturer</b> Mayoral
                </li>
                <li>
                    <b>Material</b> Cotton
                </li>
                <li>
                    <b>Pattern Type</b> Print
                </li>
                <li>
                    <b>Wash</b> Colored
                </li>
                <li>
                    <b>Style</b> Cute
                </li>
                <li>
                    <b>Color</b> Blue, Red
                </li>
                <li><a href="#" class="prod-showprops">All Features</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Quick View Product - end -->
