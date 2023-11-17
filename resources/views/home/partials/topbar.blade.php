<!-- Topbar - start -->
<div class="header_top">
    <div class="container">
        <ul class="contactinfo nav nav-pills">
            <li>
                <i class='fa fa-phone'></i> +62 815 2996 3914
            </li>
            <li>
                <i class="fa fa-envelope"></i> {{ env('MAIL_FROM_ADDRESS') }}
            </li>
        </ul>
        <!-- Social links -->
        <ul class="social-icons nav navbar-nav">
            <li>
                <a href="http://facebook.com/" rel="nofollow" target="_blank">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="http://twitter.com/" rel="nofollow" target="_blank">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="http://instagram.com/" rel="nofollow" target="_blank">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Topbar - end -->
<!-- Logo, Shop-menu - start -->
<div class="header-middle">
    <div class="container header-middle-cont">
        <div class="toplogo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets') }}/img/logo.png" alt="AllStore - MultiConcept eCommerce Template">
            </a>
        </div>
        <div class="shop-menu">
            <ul>

                @if (!auth()->user())
                    <li class="topauth">
                        <a href="{{ url('register') }}">
                            <i class="fa fa-lock"></i>
                            <span class="shop-menu-ttl">Registration</span>
                        </a>
                        <a href="{{ url('login') }}">
                            <span class="shop-menu-ttl">Login</span>
                        </a>
                    </li>
                @else
                    <li class="topauth">

                        <a href="#">
                            <span class="shop-menu-ttl">{{ auth()->user()->email }}</span>
                        </a>
                        <a href="{{ url('chart') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="shop-menu-ttl">Cart</span>
                            (<b class="userID" data-user_id="{{ auth()->user()->id }}">0</b>)
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
<!-- Logo, Shop-menu - end -->
<!-- Topmenu - start -->
<div class="header-bottom">
    <div class="container">
        <nav class="topmenu">

            @php
                $category_all = App\Models\Categories::all();
            @endphp
            <!-- Catalog menu - start -->
            <div class="topcatalog">
                <a class="topcatalog-btn" href="{{ url('catalog') }}"><span>All</span> catalog</a>
                <ul class="topcatalog-list">
                    @foreach ($category_all as $i)
                        <li>
                            <a href="{{ url('catalog?category=' . $i->category_slug) }}">
                                {{ str_replace('TEMPLATES', '', strtoupper($i->category_name)) }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
            <!-- Catalog menu - end -->

            <!-- Main menu - start -->
            <button type="button" class="mainmenu-btn">Menu</button>

            <ul class="mainmenu">
                {{-- <li>
                    <a href="index.html" class="active">
                        Home
                    </a>
                </li>
                <li class="menu-item-has-children">
                    <a href="catalog-list.html">
                        Catalog <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="catalog-list.html">
                                Catalog List - Style 1
                            </a>
                        </li>
                        <li>
                            <a href="catalog-list-2.html">
                                Catalog List - Style 2
                            </a>
                        </li>
                        <li>
                            <a href="catalog-gallery.html">
                                Catalog Gallery - Style 1
                            </a>
                        </li>
                        <li>
                            <a href="catalog-gallery-2.html">
                                Catalog Gallery - Style 2
                            </a>
                        </li>
                        <li>
                            <a href="catalog-table.html">
                                Catalog Table
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="mainmenu-more">
                    <span>...</span>
                    <ul class="mainmenu-sub"></ul>
                </li> --}}
            </ul>
            <!-- Main menu - end -->

            <!-- Search - start -->
            <div class="topsearch">
                <a id="topsearch-btn" class="topsearch-btn" href="#"><i class="fa fa-search"></i></a>
                <form class="topsearch-form" action="{{ url('catalog') }}" method="GET">
                    @if ($category)
                        <input type="hidden" name="category" value="{{ $category }}">
                    @endif
                    <input type="text" placeholder="Search products" name="search"
                        value="{{ $_GET['search'] ?? '' }}">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <!-- Search - end -->

        </nav>
    </div>
</div>
<!-- Topmenu - end -->
@push('script')
    <script>
        const userID = $('.userID').data('user_id');
        $.ajax({
            url: `/api/chart/${userID}`,
            method: 'GET',
            dataType: 'json',
            success: function(rs) {
                console.log(rs);
                $('.userID').html(rs.count);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    </script>
@endpush