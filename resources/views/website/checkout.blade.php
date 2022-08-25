@extends('layouts.website.app')

@section('title')
    Checkout
@endsection

@section('styles')
    <style>
        .additional-info .form-field textarea,
        .checkout-form .form-field input {
            color: #6c757d !important;
        }
    </style>
@endsection

@section('pageName')

    <body class="page-article dm-light">
    @endsection

    @section('content')
        <section class="page-header"
            style="background-image: url({{ asset('website2-assets/img/page-header-theme.jpg') }})">
            <div class="bg-shape grey"></div>
            <div class="container">
                <div class="page-header-content">
                    <h4>
                        {{ __('general.Checkout') }}
                    </h4>
                    <h2>
                        {{ __('general.checkout_tilte') }}
                    </h2>
                </div>
            </div>
            </section>
            <!--/.page-header-->

            <section class="checkout-section bg-grey padding">
                <div class="container">
                    <form class="checkout-form-wrap"method="post">
                        <div class="row">

                            <div class="col-lg-8 sm-padding">

                                @csrf
                                <h2>{{ __('general.Personal information') }}</h2>
                                <div class="checkout-form mb-30">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="full_name" style="line-height: 3;">
                                                {{ __('general.Full name') }}</label>
                                        </div>
                                        <div class="form-field col-md-8">
                                            <input type="text" id="full_name" name="full_name" class="form-control"
                                                value="{{ auth()->user()->name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="Phone" style="line-height: 3;"> {{ __('general.Phone') }}</label>
                                        </div>
                                        <div class="form-field col-md-8">
                                            <input type="text" id="Phone" name="Phone" class="form-control"
                                                value="{{ auth()->user()->first_phone }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="Email" style="line-height: 3;"> {{ __('general.Email') }}</label>
                                        </div>
                                        <div class="form-field col-md-8">
                                            <input type="text" id="Email" name="Email" class="form-control"
                                                value="{{ auth()->user()->email }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                @if (isset($address))
                                    <h2>{{ __('general.We will deliver your address to') }}</h2>
                                    <div class="checkout-form mb-30">
                                        <div class="row">
                                            <p class="small text m-0">{{ $address->name }}
                                                ,
                                                {{ app()->getLocale() == 'ar' ? $address->city->name_ar : $address->city->name_en }}
                                                ,
                                                {{ app()->getLocale() == 'ar' ? $address->area->name_ar : $address->area->name_en }}
                                            </p>
                                        </div>
                                        <div class="row">
                                            <p class="small text m-0">{{ $address->street }}
                                                , {{ __('general.BuildNo') }}: {{ $address->building_number }}
                                                , {{ __('general.FloorNo') }}: {{ $address->floor_number }}
                                                , {{ __('general.Landmark') }}: {{ $address->landmark }}
                                            </p>
                                        </div>

                                    </div>
                                @endif

                                @if (isset($branch))
                                    <h2>{{ __('general.Receive Your Order From') }}</h2>
                                    <div class="checkout-form mb-30">
                                        <div class="row">
                                            <p class="">
                                                {{ app()->getLocale() == 'ar' ? $branch->name_ar : $branch->name_en }}</p>

                                            <p class="small text m-0">
                                                {{ app()->getLocale() == 'ar' ? $branch->address_description_ar . ' ' . $branch->city->name_ar . ' ' . $branch->area->name_ar : $branch->address_description_en . ' ' . $branch->city->name_en . ' ' . $branch->area->name_en }}
                                            </p>
                                        </div><br>
                                        <div class="row">
                                            @if (isset($work_hours))
                                                <h6 class="mb-0">{{ __('general.Working Hours') }}</h6>
                                                @foreach ($work_hours as $h)
                                                    <p class="small text-muted m-0">{{ __('general.From') }}
                                                        : {{ $h->time_from }} {{ __('general.To') }}
                                                        :{{ $h->time_to }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <!-- <div class="additional-info mb-30">
                                            <h2>Additional Information</h2>
                                            <div class="form-field">
                                                <textarea id="message" name="message" cols="30" rows="3" class="form-control" placeholder="Order Note"></textarea>
                                            </div>
                                        </div> -->
                                <div class="payment-method">
                                    <h2>
                                        {{ __('general.Payment') }}
                                    </h2>
                                    <div class="mb-20">
                                        <button class="btn btn-success btn-block btn-lg" type="submit"
                                            formaction="{{ route('make_order') }}">
                                            {{ __('general.Confirm Order Cash') }}
                                            <i class="feather-arrow-right"></i>
                                        </button>
                                        <button class="btn btn-success btn-block btn-lg" type="submit"
                                            formaction="{{ route('payment') }}">
                                            {{ __('general.Confirm Order OnlinePay') }}
                                            <i class="feather-arrow-right"></i>
                                        </button>
                                    </div>
                                    <ul class="mb-20">
                                        <input id="subtotalinput" hidden name="subtotal"
                                            value="{{ $request->subtotal }} " />

                                        <input id="taxesinput" hidden name="taxes"
                                            value="{{ round($request->taxes, 2) }}" />

                                        <input id="delivery_feesnput" hidden name="delivery_fees"
                                            value="{{ $request->delivery_fees }}" />

                                        @if ($request->has('points_paid'))
                                            <input id="pointsinput" hidden
                                                name="points_paid"value="{{ $request->points_paid }}" />
                                        @endif
                                        @if ($request->has('branch_id'))
                                            <input hidden name="branch_id" value="{{ $request->branch_id }}" />
                                        @endif
                                        @if ($request->has('address_id'))
                                            <input id="pointsinput" hidden name="address_id"
                                                value="{{ $request->address_id }}" />
                                        @endif
                                        @if ($request->has('service_type'))
                                            <input id="pointsinput" hidden name="service_type"
                                                value="{{ $request->service_type }}" />
                                        @endif
                                        @auth()
                                            <input id="pointsinput" hidden name="customer_id"
                                                value="{{ auth()->user()->id }}" />
                                        @endauth
                                        <input id="delivery_feesnput" hidden name="total"
                                            value="{{ $request->total }}" />

                                        <li>
                                            <input type="radio" id="option-1" name="selector" checked="">
                                            <label for="option-1">Direct Bank Transfer</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="option-2" name="selector">
                                            <label for="option-2">Check Payments</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="option-3" name="selector">
                                            <label for="option-3">Cash On Delivery</label>
                                        </li>
                                    </ul>
                                    <a href="#" class="default-btn">Place Order <span></span></a>
                                </div>


                            </div>
                            <div class="col-lg-4 sm-padding">
                                <ul class="cart-total">
                                    <li><span>{{ __('general.Sub Total') }}:</span>{{ $request->subtotal }}
                                        {{ __('general.SR') }}</li>

                                    <li><span>{{ __('general.Taxes') }} :</span>{{ round($request->taxes, 2) }}
                                        {{ __('general.SR') }}</li>

                                    <li><span>{{ __('general.Delivery Fees') }} :</span>{{ $request->delivery_fees }}
                                        {{ __('general.SR') }}</li>

                                    @if ($request->has('points_paid'))
                                        <li><span>{{ __('general.Loyality Points') }} :</span> <span>-
                                                {{ round($request->points_paid, 2) }} {{ __('general.SR') }}</span></li>
                                    @endif
                                    <li><span>{{ __('general.Total') }} :</span>{{ $request->total }}
                                        {{ __('general.SR') }}
                                    </li>



                                    <!-- <li><a href="shop.html">Continue Shopping</a><a href="#" class="default-btn">Checkout <span></span></a></li> -->
                                </ul>
                                <div class="row my-3">
                                    <div class="col-xs-12">
                                        <div class="card-header">
                                            <h5 class='card-title'>
                                                {{ __('general.Description') }}
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="{{ __('general.desc_label') }}" id="floatingTextarea2"
                                                    style="height: 200px" name="description" value="{{ old('description') }}"></textarea>
                                                <label for="floatingTextarea2">

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </form>
                </div>
            </section>
            <!--/.checkout-section-->

        @endsection

        @section('scripts')
        @endsection
