@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gifts Orders</h1>
                </div>
                <div class="col-sm-6">
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
                            <th>ID</th>
                            <th>Ordered Gifts</th>
                            <th>User</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as  $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>
                                @foreach($order->gifts as $gift)
                                    - {{$gift->name_en}} <br>
                                @endforeach
                            </td>
                            <td><a href="{{  'customer/'.$order->user->id }}">{{$order->user->name}}</a></td>
                            <td>{{$order->created_at->format('d-m-Y g:i A')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
