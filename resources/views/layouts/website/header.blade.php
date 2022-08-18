<header class="header">
    <div class="primary-header-one primary-header">
        <div class="container">
            <div class="primary-header-inner">
                <div class="header-logo">
                    <a href="{{ route('home.page') }}">
                        <img class="light" src="{{ asset('website-assets/img/logokop.bmp') }}" alt="Logo" />
                        {{-- <img class="dark" src="{{ asset('website-assets/img/logokop.bmp') }}" alt="Logo" /> --}}
                    </a>
                </div><!-- /.header-logo -->
                <div class="header-menu-wrap">
                    <ul class="slider-menu">
                        {{-- <li><a href="{{ route('home.page') }}">{{ __('header.Home') }}</a>
                            <!-- <ul>
                                <li><a href="{{ route('home.page') }}">{{ __('header.Home') }}</a></li>
                            </ul> -->
                        </li> --}}
                        {{-- <<<<<<< HEAD
                        <li><a href="{{route('menu.page')}}">{{ __('header.Menu')}}</a></li>
                        <li><a class="cart" @auth @if (!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif @endauth href="{{route('offers')}}">{{ __('header.Offers')}}</a></li>
                        <li><a href="{{route('get.cart')}}">{{ __('header.Cart')}}</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="#">Pages</a>
======= --}}
                        <li><a href="javascript:void0">{{ __('header.Menu') }}</a>
                            {{-- >>>>>>> ahmed --}}
                            <ul>
                                <li><a href="{{ route('menu.page') }}">{{ __('header.Menu') }}</a></li>
                                <li><a href="{{ route('takeaway.page') }}">{{ __('general.Branches') }}</a></li>
                                {{-- <li><a href="{{ route('offers') }}">{{ __('header.Offers') }}</a></li> --}}
                                <li><a class="cart" @auth
                                            @if (!session()->has('branch_id')) data-toggle="modal" data-target="#service-modal" @endif
                                        @endauth href="{{ route('offers') }}">{{ __('header.Offers') }}</a></li>
                            </ul>
                        </li>
                        {{-- <li><a href="{{ route('get.cart') }}">{{ __('header.Cart') }}</a></li> --}}
                        <li><a href="javascript:void0">{{ __('general.contact_us') }}</a>
                            <ul>
                                <li><a href="{{ route('aboutUS.page') }}">
                                        {{ __('general.about_us') }}</a></li>
                                <li><a href="{{ route('contact.page') }}">
                                        {{ __('general.contact_us') }}
                                    </a></li>
                            </ul>
                        </li>


                        <li><a href="javascript:void0">{{ __('general.Gallery') }}</a>
                            <ul>
                                <li><a href="{{ route('gallery.page') }}">{{ __('general.Gallery') }}</a></li>
                                <li><a href="{{ route('video.page') }}">{{ __('general.Video Library') }}</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void0">
                                {{ __('general.blog') }}
                            </a>
                            <ul>
                                <li><a href="{{ route('news.all') }}">
                                        {{ __('general.blog') }}
                                    </a></li>
                                <li><a href="{{ route('health-infos.all') }}">
                                        {{ __('general.Health Information') }}
                                    </a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('careers.all') }}">{{ __('general.Careers') }}</a></li>
                        <li><a href="javascript:void0">{{ __('general.language') }}</a>
                            <ul>
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li style="{{ strpos(url()->current(), "/$localeCode") > 0 ? 'background-color: #ff8e28;color: #fff' : '' }}">
                                        <a rel="alternate" hreflang="{{ $localeCode }}"
                                            href="{{ strpos(url()->current(), "/$localeCode") > -1 ? 'javascript:void0' : LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                             class='w-full'>
                                            @if ($localeCode === 'ar')
                                                <img src="{{ asset('/website2-assets/img/icons/sa.svg') }}"
                                                    width="16" height="16" />
                                            @else
                                                <img src="{{ asset('/website2-assets/img/icons/us.svg') }}"
                                                    width="16" height="16" />
                                            @endif

                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- /.header-menu-wrap -->
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
