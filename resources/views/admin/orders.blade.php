@extends('layouts.admin')

@section('content')
    <div class="card">
      <div class="card-sm bg-primary">
        <span class="glyphicon glyphicon-qrcode"></span>
        <div class="card-content">
            <div class="card-text">Pending orders</div>
        </div>
      </div>
    </div>
    <hr>
    @include('layouts.partials.flash_message')
    <table class="table table-striped">
        <thead>
            <tr>
                <td>#</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Ordered by</td>
                <td>Ordered on</td>
                <td>View</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach( $orders as $order )
            <tr>
              <td>{{$order->id}}</td>
              <td>{{ $order->totalQuantity() }}</td>
              <td>Php {{ $order->totalPrice() }}</td>
              <td>User {{ $order->user_id }}</td>
              <td>{{ $order->created_at }}</td>
              <td>
                  <a href="{{ URL::action('OrderController@show', $order->id) }}">
                      <button class="btn btn-primary btn-xs">View Items</button>
                  </a>
              </td>
              @if( $order->status == 0 )
              <td><span class="label label-info">Pending</span></td>
              @elseif( $order->status == 1 )
              <td><span class="label label-info">Processing</span></td>
              @endif
              <td>
                <a href="{{ URL::action('OrderController@updateProcessing', $order->id) }}">
                  <button class="btn btn-primary">Set to Processing</button>
                </a>
                <a href="{{ URL::action('OrderController@updateDelivery', $order->id) }}">
                  <button class="btn btn-primary">Set to Delivery</button>
                </a>
              </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
