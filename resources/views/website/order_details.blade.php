@extends('layouts.website.app')

@section('title')
    {{ __('general.order_details') }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('website2-assets/css/style2.css') }}">
    <style>
        .page-header__top {
            margin: 20px 0px 30px !important;
        }

        a:hover,
        a:focus {
            color: #ff0000;
            text-decoration: none;
        }

        .stepper-type-2 .stepper-arrow.up {
            top: 0;
            margin-top: -5px;
        }

        .stepper-type-2 .stepper-arrow.down {
            top: 100%;
            margin-top: -20px;
            font-size: 20px;
        }

        td {
            border: 0 !important;
        }
    </style>
@endsection

@section('pageName')

    <body class="page-article dm-light">
    @endsection

    @section('content')
        <main class="page-main">
            <section class="page-header"
                style="background-image: url({{ asset('website-assets/img/pages/home/careers.jpg') }})">
                <div class="bg-shape grey"></div>
                <div class="container">
                    <div class="page-header-content">
                        <h4 class="text-white">
                            {{ __('general.My Orders') }}
                        </h4>
                        <h2 class="text-warning">
                            {!! __('general.find_your_orders') !!}
                        </h2>
                    </div>
                </div>
            </section>
            <!--/.page-header-->

            <div class="page-content">

                <div class="uk-margin-large-top uk-container uk-container-small">
                    <section class="section-50">
                        <div class="shell">
                            <div class="range">
                                @if (isset($items))
                                    <div class="cell-xs-12">
                                        <h4 class="text-left font-default"><span id="itemcount">{{ $items->count() }}</span>
                                            {{ __('general.Items in your cart') }}</h4>
                                        <div class="table-responsive offset-top-10" style="border-radius: 10px;">
                                            <table class="table table-shopping-cart mt-4">
                                                <tbody>
                                                    @foreach ($items as $item)
                                                        <tr class="card1{{ $item->id }}" style="height: 10px"></tr>
                                                        <tr class="cart2{{ $item->id }}"
                                                            style="background-color: #e6e6e68c!important;box-shadow: 0.1rem 0rem 1.5rem rgb(0 0 0 / 20%);border-radius: 5px; margin-bottom: 10px">
                                                            <td class="p-4 pr-0 pl-0" style="width: 170px;height: 170px">
                                                                <div class="w-100 h-100">
                                                                    <div class="product-image w-100 h-100"><img
                                                                            src="{{ asset($item->image) }}"
                                                                            class="img-thumbnail w-100 h-100"
                                                                            style="border-radius: 10px;" alt="">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="min-width: 340px;">
                                                                <div class="text-left">
                                                                    <div class="row w-100 m-0">
                                                                        <div class="col-8">
                                                                            <span
                                                                                class="h5 text-sbold product-brand text-italic"
                                                                                style="font-size: 25px;">{{ app()->getLocale() == 'ar' ? $item->name_ar : $item->name_en }}</span>
                                                                            <div class="offset-top-0">

                                                                                <p> {{ __('menu.Calories') }} :
                                                                                    {{ $item->calories }}</p>
                                                                                <p class="text-bold">
                                                                                    {{ __('general.Quantity') }}:
                                                                                    {{ $item->pivot->quantity }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4 text-center">
                                                                            <div class="p-2 mr-4">
                                                                                <span class="h6 d-block"
                                                                                    style=" @if ($item->valid == 1) text-decoration: line-through; @endif ">{{ __('menu.Price') }}:
                                                                                    {{ round($item->pivot->price, 2) }}
                                                                                    {{ __('general.SR') }}</span>
                                                                                @if ($item->pivot->offer_id)
                                                                                    <span
                                                                                        class="h6 @if ($item->valid == 1) text-success @else text-danger @endif mt-2"
                                                                                        style=" @if ($item->valid == 0) text-decoration: line-through; @endif ">{{ __('menu.Offer Price') }}:
                                                                                        {{ round($item->pivot->offer_price, 2) }}
                                                                                        {{ __('general.SR') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if (!$item->pivot->offer_id || $item->pivot->dough_type_ar)
                                                                        <div>
                                                                            <div class="row w-100 m-0 mt-3">
                                                                                <div class="col-3">
                                                                                    <p>{{ __('general.Dough Type') }}
                                                                                        :
                                                                                        {{ app()->getLocale() == 'ar' ? $item->pivot->dough_type_ar : $item->pivot->dough_type_en }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif


                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="cart3{{ $item->id }}" style="height: 30px">

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="mt-5 offset-9 col-xs-3" style="width: max-content">
                                            <div class="h4 font-default text-bold">
                                                <h6 class="mt-1 mb-2"><b
                                                        class="inset-right-5 text-gray-light">{{ __('general.Sub Total') }}:
                                                    </b>
                                                    <span id="subtotal" style="font-size: smaller;">
                                                        {{ $order->subtotal }} {{ __('general.SR') }}</span>
                                                </h6>
                                                <h6 class="mt-1 mb-2"><b
                                                        class="inset-right-5 text-gray-light">{{ __('general.Taxes') }}:
                                                    </b>
                                                    <span id="taxes" style="font-size: smaller;"> {{ $order->taxes }}
                                                        {{ __('general.SR') }}</span>
                                                </h6>
                                                <h6 class="mt-1 mb-2"><b
                                                        class="inset-right-5 text-gray-light">{{ __('general.Delivery Fees') }}:
                                                    </b> <span id="delivery_fees" style="font-size: smaller;">
                                                        {{ $order->delivery_fees }} {{ __('general.SR') }}</span>
                                                </h6>

                                                @if ($order->points_paid != 0 && !isset($reorder))
                                                    <h6 class="mt-1 mb-2"><b
                                                            class="inset-right-5 text-gray-light">{{ __('general.Loyality Discount') }}:
                                                        </b> <span id="points" style="font-size: smaller;"> -
                                                            {{ $order->points_paid }} {{ __('general.SR') }}</span>
                                                    </h6>
                                                @endif
                                                @if (session()->has('point_claim_value') && isset($reorder))
                                                    <h6 class="mt-1 mb-2"><b
                                                            class="inset-right-5 text-gray-light">{{ __('general.Loyality Discount') }}:
                                                        </b> <span id="points" style="font-size: smaller;"> -
                                                            {{ session()->get('point_claim_value') }}
                                                            {{ __('general.SR') }}</span>
                                                    </h6>
                                                    <h6 class="mt-1 mb-2"><b
                                                            class="inset-right-5 text-gray-light">{{ __('general.Total') }}:
                                                        </b> <span style="font-size: smaller;" id="total">
                                                            {{ $order->total - session('point_claim_value') }}
                                                            {{ __('general.SR') }}</span>
                                                    </h6>
                                                @else
                                                    <h6 class="mt-1 mb-2"><b
                                                            class="inset-right-5 text-gray-light">{{ __('general.Total') }}:
                                                        </b> <span style="font-size: smaller;" id="total">
                                                            @if (!isset($reorder))
                                                                {{ $order->total - $order->points_paid }}
                                                            @else
                                                                {{ $order->total }}
                                                            @endif {{ __('general.SR') }}
                                                        </span>
                                                    </h6>
                                                @endif

                                            </div>
                                            @if (isset($reorder))
                                                <a class="uk-button w-100" style="border-radius: 5px;"
                                                    href="{{ route('re.order', $order->id) }}" data-target="#service-modal">
                                                    {{ __('general.Confirm Order') }} </a>
                                            @endif
                                        </div>

                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    @endsection

    @section('scripts')
        <script src="{{ asset('website2-assets/js/core.min.js') }}"></script>
        <script src="{{ asset('website2-assets/js/script.js') }}"></script>
    @endsection
