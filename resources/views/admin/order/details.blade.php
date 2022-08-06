@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Order Details</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="card-body">
        <table class="table table-bordered table-striped dataTable">
          <thead>
            <tr>
              <th>Order #</th>
              <th>Item</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Offer Price</th>
              <th>Offer Type</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orderDetails as $order)
              <tr>
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->item['name_'.app()->getLocale()] }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->price }}</td>
                <td>{{ $order->offer_price }}</td>
                <td>{{ $order->offer->offer_type ?? ''}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
@endsection
