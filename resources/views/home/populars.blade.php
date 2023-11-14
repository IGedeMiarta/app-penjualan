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
                            <a href="product.html" class="prod-i-img"><!-- NO SPACE --><img src="{{ $pal->images() }}"
                                    alt="Aspernatur excepturi rem" width="250" height="350"><!-- NO SPACE --></a>
                            {{-- <p class="prod-i-info text-center">
                                <a href="#" class="prod-i-favorites"><span>Wishlist</span><i
                                        class="fa fa-heart"></i></a>
                            </p> --}}
                            <p class="prod-i-addwrap">
                                <a href="#" class="prod-i-add qview-btn btnDetails" data-id="{{ $pal->id }}"
                                    data-name="{{ $pal->product_name }}" data-price="{{ $pal->price }}"
                                    data-slug="{{ $pal->product_slug }}"
                                    data-category="{{ $pal->category->category_name }}"
                                    data-id_category="{{ $pal->id_category }}" data-tags="{{ $pal->tags() }}"
                                    data-desc="{{ $pal->description }}">Go to
                                    detail</a>
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
                    $product = App\Models\Product::with('category')
                        ->where('id_category', $item->id)
                        ->orderByDesc('id')
                        ->get();
                @endphp
                <ul class="slides">
                    @foreach ($product as $p)
                        <li class="prod-i">
                            <div class="prod-i-top">
                                <a href="product.html" class="prod-i-img"><!-- NO SPACE --><img
                                        src="{{ $p->images() }}" alt="Aspernatur excepturi rem" width="250"
                                        height="350"><!-- NO SPACE --></a>
                                {{-- <p class="prod-i-info text-center">
                                <a href="#" class="prod-i-favorites"><span>Wishlist</span><i
                                        class="fa fa-heart"></i></a>
                            </p> --}}
                                <p class="prod-i-addwrap">
                                    <a href="#" class="prod-i-add qview-btn btnDetails"
                                        data-id="{{ $p->id }}" data-name="{{ $p->product_name }}"
                                        data-price="{{ $p->price }}" data-slug="{{ $p->product_slug }}"
                                        data-category="{{ $p->category->category_name }}"
                                        data-id_category="{{ $p->id_category }}" data-tags="{{ $p->tags() }}"
                                        data-desc="{{ $p->description }}">Go to
                                        detail</a>
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
        @endforeach



    </div><!-- .fr-pop-tab-cont -->


</div><!-- .fr-pop-wrap -->


<!-- Quick View Product - start -->
<div class="qview-modal">
    <div class="prod-wrap">
        <a href="product.html">
            <h3 class="main-ttl">
                <span id="categoryText">Template Details</span>
            </h3>
        </a>
        <div class="prod-slider-wrap">
            <div class="prod-slider" id="imgSlider">
            </div>

        </div>

        <div class="prod-cont">
            <h1 class="mt-n5">
                <h2 id="productName"></h2>
            </h1>

            <div class="prod-skuwrap">
                <p class="prod-skuttl">Tags</p>
                <ul class="prod-skucolor">
                    <div class="showTags"></div>

                </ul>
            </div>
            <div class="prod-info">
                <p class="prod-price">
                    <b class="item_current_price" id="price">$238</b>
                </p>
                <p class="prod-addwrap">
                    <a href="#" class="prod-add"><i class="fa fa-shopping-cart  mr-2"></i> Add to cart</a>
                </p>
            </div>
            <ul class="prod-i-props">
                <li>

                    <p class="detailsHire"></p>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Quick View Product - end -->
@push('script')
    <script>
        $('.btnDetails').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const name = $(this).data('name');
            const price = $(this).data('price');
            const slug = $(this).data('slug');
            const category = $(this).data('category');
            const id_category = $(this).data('id_category');
            const tags = $(this).data('tags');
            const desc = $(this).data('desc');
            var details = $(this).data('desc');
            $('#productName').html(name);
            $('.showTags').html(tags);
            $('#price').html(number_format(price));
            details = details.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            details = details.replace(/\n/g, '<br>');
            // $('.detailsHire').html(desc.replace(/\n/g, '<br>'))
            $('.detailsHire').html(details);
            // $('#categoryText').html(category + ' Templates')

            $.ajax({
                url: `/api/media/${id}`,
                method: 'GET',
                dataType: 'json',
                success: function(rs) {
                    // Update the content on the webpage with the data from the server
                    let slide = ' <ul class="prod-slider-car">';
                    rs.data.media.forEach(function(url, index) {
                        slide += `<li class="float: left; list-style: none; position: relative; width: 464px;"><a data-fancybox-group="popup-product" class="fancy-img" href="${url}"  target="_blank">
                                                <img src="${url}" alt="">
                                            </a>
                                        </li>`
                    });
                    slide += '</ul>';
                    console.log(slide);
                    $('#imgSlider').html(slide)

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        })

        function number_format(number) {
            return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
@endpush
