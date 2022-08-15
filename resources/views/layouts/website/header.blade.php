<header class="header">
    <div class="primary-header-one primary-header">
        <div class="container">
            <div class="primary-header-inner">
                <div class="header-logo">
                    <a href="#">
                        <img class="light" src="{{asset('website-assets/img/logokop.bmp')}}" alt="Logo"/>
                        <img class="dark" src="{{asset('website-assets/img/logokop.bmp')}}" alt="Logo"/>
                    </a>
                </div><!-- /.header-logo -->
                <div class="header-menu-wrap">
                    <ul class="slider-menu">
                        <li><a href="index.html">Home</a>
                            <ul>
                                <li><a href="{{route('home.page')}}">{{ __('header.Home')}}</a></li>
                                <li><a href="index-2.html">Home Modern</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('menu.page')}}">{{ __('header.Menu')}}</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="#">Pages</a>
                            <ul>
                                <li><a href="gallery.html">Food Gallery</a></li>
                                <li><a href="reviews.html">Reviews</a></li>
                                <li><a href="team.html">Our Chef</a></li>
                                <li><a href="food-menu.html">Food Menu</a></li>
                                <li><a href="reservation.html">Reservation</a></li>
                                <li><a href="faqs.html">Help &amp; Faq's</a></li>
                                <li><a href="404.html">404 Error</a></li>
                            </ul>
                        </li>
                        <li><a href="shop.html">Shop</a>
                            <ul>
                                <li><a href="shop.html">Shop Grid</a></li>
                                <li><a href="shop-details.html">Shop Details</a></li>
                                <li><a href="cart.html">Cart Page</a></li>
                                <li><a href="checkout.html">Checkout Page</a></li>
                                
                            </ul>
                        </li>
                        <li><a href="blog-grid.html">Blog</a>
                            <ul>
                                <li><a href="blog-grid.html">Grid Layout</a></li>
                                <li><a href="blog-classic.html">Classic Layout</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div><!-- /.header-menu-wrap -->
                <!-- <div class="header-right">
                    <div class="search-icon dl-search-icon"><i class="las la-search"></i></div>
                    <a class="header-btn" href="reservation.html">Reservation<span></span></a>
                  Burger menu 
                    <div class="mobile-menu-icon">
                        <div class="burger-menu">
                            <div class="line-menu line-half first-line"></div>
                            <div class="line-menu"></div>
                            <div class="line-menu line-half last-line"></div>
                        </div>
                    </div>
                </div>/.header-right -->
            </div><!-- /.primary-header-one-inner -->
        </div>
    </div><!-- /.primary-header-one -->
</header><!-- /.header-one -->
