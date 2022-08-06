@extends('layouts.website.app')

@section('title') Contacts @endsection

@section('styles')@endsection

@section('pageName')
    <body class="page-contacts dm-dark"> @endsection

    @section('content')
        <main class="page-main">
            <div class="section-first-screen">
                <div class="first-screen__bg"
                     style="background-image: url({{asset('website-assets/img/pages/home/contactus.jpg')}})"></div>
                <div class="first-screen__content">
                    <div class="uk-container">
                        <div class="first-screen__box">
                            <h2 class="first-screen__title">{{__('contact_us.Contact Us')}}</h2>
                            <div class="first-screen__breadcrumb">
                                <ul class="uk-breadcrumb">
                                    <li><a href="{{route('home.page')}}">{{__('contact_us.Home')}}</a></li>
                                    <li><span>{{__('contact_us.Contact Us')}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-contacts-form">
                <div class="uk-section uk-container">
                    <div class="uk-grid" data-uk-grid>
                        <div class="uk-width-1-3@m">
                            <div class="section-title burger wave">
                                <h3 class="uk-h3">{{__('contact_us.Contact Details')}}</h3>
                            </div>
                            <div class="section-content">
                                <div class="uk-text-large">{{__('general.ownername')}}</div>
                                <div>الأحساء - المبرز - شارع البستان - برج الملحم الأداري - الدور الثالث<br> المملكة العربية السعودية</div><ul class="contacts-list">
                                    <li><span>{{__('general.Phone')}}: </span><a style="color: #f00;" href="tel:920001939">920001939</a></li>
                                    <li><span>{{__('general.Email')}}: </span><a style="color: #f00;" href="mailto:Admin@gulfinvestment.net">Admin@gulfinvestment.net</a></li>
                                </ul>
                                <hr class="uk-margin">
                                <div class="block-with-phone"><img
                                        src="{{asset('website-assets/img/icons/delivery.svg')}}" alt="delivery"
                                        data-uk-svg>
                                    <div><span>{{__('general.For Delivery, Call us')}}</span><a href="tel:920001939">920001939</a>
                                    </div>
                                </div>
                                <hr class="uk-margin">
                                <div class="block-with-phone"><img
                                        src="{{asset('website-assets/img/icons/delivery.svg')}}" alt="delivery"
                                        data-uk-svg>
                                    <div><b>{{__('general.Delivery Hours')}}</b>
                                        <div>@lang('footer.Sat') – @lang('footer.Thur'): 05:00 @lang('footer.AM') – 12:00 @lang('footer.PM')<br> @lang('footer.Sat') – @lang('footer.Thur'): 04:00 @lang('footer.PM') – 01:00 @lang('footer.AM')<br> @lang('footer.Fri'): 05:00 @lang('footer.AM') – 10:30 @lang('footer.AM')<br> @lang('footer.Fri'): 04:00 @lang('footer.PM') – 01:00 @lang('footer.AM')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-2-3@m">
                            <div class="section-title burger wave">
                                <h3 class="uk-h3">{{__('contact_us.Send us a Message')}}</h3>
                            </div>
                            <div class="section-content">
                                @if(Session::has('success'))
                                    <div class="row mr-2 ml-2">
                                        <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                                                id="type-error">{{Session::get('success')}}
                                        </button>
                                    </div>
                                @endif
                                @if(Session::has('error'))
                                    <div class="row mr-2 ml-2">
                                        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                                id="type-error">{{Session::get('error')}}
                                        </button>
                                    </div>
                                @endif
                                <form action="{{route('contact.store')}}" method="POST">
                                    @csrf
                                    <div class="uk-grid uk-grid-medium uk-child-width-1-2@s" data-uk-grid>
                                        <div class="uk-width-1-1">
                                            <select name="subject" class="uk-input mb-2">
                                                <option value="@lang('contact_us.suggestions')">@lang('contact_us.suggestions')</option>
                                                <option value="@lang('contact_us.message_us')">@lang('contact_us.message_us')</option>
                                                <option value="@lang('contact_us.complaints')">@lang('contact_us.complaints')</option>
                                            </select>  
                                        <div class="uk-width-1-1"><textarea class="uk-textarea" name="body"
                                                                            placeholder="{{__('general.Message')}}">{{old('body')}}</textarea>
                                            @error('body')
                                            <div class="help-block">{{ $message }}</div>
                                            @enderror</div>
                                    </div>
                                    <div><input class="uk-button mt-2" type="submit"
                                                value="{{__('contact_us.Send message')}}"></div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="section-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3604.3436712707835!2d49.57659688498658!3d25.39330428380537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e3796f8ba9b6a57%3A0xde25e24a4501ad0f!2z2KjYsdisINin2YTZhdmE2K3ZhQ!5e0!3m2!1sar!2ssa!4v1629108955647!5m2!1sar!2ssa" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </main>
@endsection

@section('scripts')@endsection
