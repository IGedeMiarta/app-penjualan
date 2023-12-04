<!-- Popular Products -->
<div class="fr-pop-wrap">

    <h3 class="component-ttl"><span>Popular products</span></h3>

    <ul class="fr-pop-tabs sections-show">
        <li><a data-frpoptab-num="1" data-frpoptab="#all" href="#" class="active">All
                Categories</a></li>
        @foreach ($category_all as $i => $item)
            <li>
                <a data-frpoptab-num="{{ $i + 1 }}" data-frpoptab="#{{ $item->category_slug }}"
                    href="#">{{ str_replace(' TEMPLATES', '', strtoupper($item->category_name)) }}</a>
            </li>
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
                            <a href="{{ url('product/' . $pal->product_slug) }}"
                                class="prod-i-img"><!-- NO SPACE --><img src="{{ $pal->images() }}"
                                    alt="Aspernatur excepturi rem"><!-- NO SPACE --></a>

                            <p class="prod-i-addwrap">
                                <a href="#" class="prod-i-add qview-btn btnDetails" data-id="{{ $pal->id }}"
                                    data-name="{{ $pal->product_name }}" data-price="{{ $pal->price }}"
                                    data-slug="{{ $pal->product_slug }}" data-brandid="{{ $pal->brand->id }}"
                                    data-brandname="{{ $pal->brand->name }}"
                                    data-category="{{ $pal->category->category_name }}"
                                    data-id_category="{{ $pal->id_category }}" data-tags="{{ $pal->tags() }}"
                                    data-desc="{{ $pal->description }}">Go to
                                    detail</a>
                            </p>
                        </div>
                        <h3>
                            <a href="{{ url('product/' . $pal->product_slug) }}">{{ $pal->product_name }}</a>
                        </h3>
                        <p class="prod-i-price">
                            <b class="text-primary">{{ 'Rp ' . number_format($pal->price, 0, '.', ',') }}</b>
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
                                <a href="{{ url('product/' . $p->product_slug) }}"
                                    class="prod-i-img"><!-- NO SPACE --><img src="{{ $p->images() }}"
                                        alt="Aspernatur excepturi rem"><!-- NO SPACE --></a>

                                <p class="prod-i-addwrap">
                                    <a href="#" class="prod-i-add qview-btn btnDetails"
                                        data-id="{{ $p->id }}" data-name="{{ $p->product_name }}"
                                        data-price="{{ $p->price }}" data-slug="{{ $p->product_slug }}"
                                        data-brandid="{{ $p->brand->id }}" data-brandname="{{ $p->brand->name }}"
                                        data-category="{{ $p->category->category_name }}"
                                        data-id_category="{{ $p->id_category }}" data-tags="{{ $p->tags() }}"
                                        data-desc="{{ $p->description }}">Go to
                                        detail</a>
                                </p>
                            </div>
                            <h3>
                                <a href="{{ url('product/' . $p->product_slug) }}">{{ $p->product_name }}</a>
                            </h3>
                            <p class="prod-i-price">
                                <b class="text-primary">{{ 'Rp ' . number_format($p->price, 0, '.', ',') }}</b>
                            </p>
                        </li>
                    @endforeach

                </ul>
            </div>
        @endforeach



    </div><!-- .fr-pop-tab-cont -->


</div><!-- .fr-pop-wrap -->

@include('home.partials.modal')
