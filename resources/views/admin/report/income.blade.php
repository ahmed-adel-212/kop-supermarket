@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Income</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="card-body">
        <form method="get">
          <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Branches</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="branch">
                        <option value="all" >All</option>
                        @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" @if(request('branch') == $branch->id) selected @endif>
                            {{ $branch->name_en }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>From</label>
                <input type="date" class="form-control" name="from" value="{{ request('from') }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>To</label>
                <input type="date" class="form-control" name="to" value="{{ request('to') }}">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label class="form-label" style="width: 100%;"></label>
                <div class="input-group pull-right">
                    <button type="submit" class="btn btn-primary" style="margin-top: 6px; height: 35px;width: 80%;">Go</button>
                </div>
              </div>
            </div>
          </div>
        </form>
          <form action="{{ route('admin.report.income') }}">

              @csrf
              @method('post')

              <div class="row">
                  <div class="col-md-6">

                      <div class="form-group">
                          <select name="order_from"  class="form-control" id="">
                              @foreach(['website', 'mobile'] as $from)
                                  <option value="{{ $from }}">{{ $from }}</option>
                              @endforeach
                          </select>
                      </div>

                  </div><!-- end of col -->

                  <div class="col-md-6">
                      <button class="btn btn-primary">Go</button>
                  </div>

              </div><!-- end of row -->

          </form>

      </div>
    </div>
  </section>
  @if(!is_null($orders))
  <section class="content">
    <div class="container-fluid">
      <div class="card-body">
        <table class="table table-bordered table-striped dataTable">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Datetime</th>
              <th>Customer Name</th>
                <th>Order From</th>
                <th>Branch Name</th>
              <th>Subtotal</th>
              <th>Taxes</th>
               <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
              <tr>
                  <td>{{$order->id}}</td>
                  <td>{{$order->created_at->format('Y-m-d H:i:')}}</td>
                  <td>{{$order->customer->name}}</td>
                  <td>{{$order->order_from}}</td>

                  <td>{{$order->branch->name_ar}}</td>
                  <td>{{$order->subtotal}}</td>
                  <td>{{$order->taxes}}</td>
                  <td>{{$order->total}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
  @endif
</div>
@endsection
