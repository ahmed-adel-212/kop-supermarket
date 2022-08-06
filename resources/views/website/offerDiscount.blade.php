@extends('layouts.website.app')

@section('title') Offer @endsection

@section('styles')@endsection

@section('pageName') <body class="page-catalog dm-dark"> @endsection

@section('content')
    <main class="page-main">
        <div class="page-content">
            <div class="uk-container">
                <div>
                    <div class="py-2">
                        <h2 class="mb-3 mt-0">{{__('general.Offer Menu')}}</h2>
                        <div class="row">
                            <div class="product-full-card__tabs w-100 mt-0">

                                <div class="row">
                                    @if($offers['details']['items']->count() > 0)
                                        <div class="col-sm-11 m-auto">
                                            <div class="col-md-12">
                                                <div class="rounded border" style="background-color: #f5f5f5!important;box-shadow: 0.1rem 0rem 1.5rem rgb(0 0 0 / 20%);">
                                                    @foreach($offers['details']['items'] as $item)
                                                        <form id="addToCard" action="{{route('add.cart')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="item_id" value="{{$item['id']}}">
                                                            <input type="hidden" name="quantity" value="{{$offers['details']['quantity']}}">
                                                            <input type="hidden" name="offer_id" value="{{$offers['details']['offer_id']}}">
                                                            <input type="hidden" name="offer_price" value="{{round($item['offer_price'], 2)}}">
                                                            <div class="gold-members p-3 border-bottom">
                                                                <button type="submit" class="btn btn-outline-secondary btn-sm float-right btnAdd">Add to cart</button>
                                                                <div class="media d-flex">
                                                                    <div class="mr-3 col-3" style="height: 150px">
                                                                        <img class="img-thumbnail rounded w-100 h-100" src="{{$item->image}}" alt="">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h6 class="m-0" style="font-size: 14px;line-height: 1.8;">{{(app()->getLocale() == 'ar')? $item['name_ar'] : $item['name_en'] }}</h6>
                                                                        <span>{{__('menu.Price')}}: </span><span class="value text-danger" style="text-decoration: line-through;font-size: 20px;" > {{$item['price']}} {{__('general.SR')}}</span>
                                                                        <span style="font-size: 26px;color:#6dc405;text-decoration: none">
                                                                            {{round($item['offer_price'], 2)}} {{__('general.SR')}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')@endsection
