<div class="sidebar-wrap">
    <div class="sidebar-widget">
        <div class="widget-tittle">
            <h2>Follow Us</h2>
            <span></span>
        </div>
        <ul class="social-widget">
            <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i>Facebook</a>
            </li>
            <li><a class="twitter" href="#"><i class="fab fa-twitter"></i>Twitter</a></li>
            <li><a class="instagram" href="#"><i class="fab fa-instagram"></i>Instagram</a></li>
            <li><a class="pinterest" href="#"><i class="fab fa-pinterest"></i>Pinterest</a></li>
            <li><a class="dribbble" href="#"><i class="fab fa-dribbble"></i>Dribbble</a>
            </li>
            <li><a class="linkedin" href="#"><i class="fab fa-linkedin"></i>Linkedin</a>
            </li>
        </ul>
    </div>

    <div class="sidebar-widget">
        <div class="widget-tittle">
            <h2>
                {{ __('general.recent') }}
            </h2>
            <span></span>
        </div>
        <ul class="recent-post">
            @foreach ($latest as $lat)
                <li>
                    <div class="thumb">
                        <img src="{{ $lat->image }}" alt="thumb">
                    </div>
                    <div class="recent-post-meta">
                        <h3><a href="{{ route('get.new', $lat->id) }}">
                                {{ $lat['title_' . app()->getLocale()] }}
                            </a></h3>
                        <a href="{{ route('get.new', $lat->id) }}" class="date"><i class="far fa-calendar-alt"></i>
                            {{ $lat->updated_at->format('d M Y') }}
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <!--/.recent-posts -->

    <div class="sidebar-widget">
        <div class="widget-tittle">
            <h2>
                {{__('general.Archives')}}
            </h2>
            <span></span>
        </div>
        <ul class="categories archive">
            @php
                $dt = now();
            @endphp
            @foreach ($archives as $arch)
                @php
                    $dt->setYear($arch->year);
                    $dt->setMonth($arch->month);
                @endphp

                <li>
                    <a href="{{route('news.archive', [$dt->year, $dt->format('m')])}}">
                        {{ $dt->locale(app()->getLocale())->monthName }}
                        <span>
                            {{ $dt->year }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <!--/. archives-->
</div>
