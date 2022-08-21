<div class="sidebar-wrap">
    @include('social-btn')

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
                        <img src="{{ asset($lat->image) }}" alt="thumb">
                    </div>
                    <div class="recent-post-meta">
                        <h3><a href="{{ route('get.new', $lat->id) }}">
                                {{ $lat['title_' . app()->getLocale()] }}
                            </a></h3>
                        <a href="{{ route('get.new', $lat->id) }}" class="date"><i class="far fa-calendar-alt"></i>
                            {{ $lat->updated_at->translatedFormat('d M Y') }}
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
