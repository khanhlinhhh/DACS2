@extends('layouts.admin')

@section('title', 'My Order Details')


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>My Order
                      
                    </h3>
                </div>
               
                        <div class="card-body">
                            <h4 class="text-primary">
                                <i class="fa fa-shopping-cart"></i> My Order Details
                                <a href="{{url('admin/order')}}" class="btn btn-danger btn-sm float-end">Back</a>
                            </h4>
                            <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order Detail</h5>
                                <hr>
                                <h6>Order Id: {{$order->id}}</h6>
                                <h6>Tracking Id/No:  {{$order->tracking_no}} </h6>
                                <h6>Ordered Date: {{$order->created_at->format('d-m-Y h:i A' )}} </h6>
                                <h6>Payment Mode: {{$order->payment_mode}} </h6>
                                <h6 class="border p-2 text-success">
                                    Order Status Message: <span class="text-uppercase">{{$order->status_message}}</span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h5>User Detail</h5>
                                <hr>
                                <h6>Full Name: {{$order->fullname}}</h6>
                                <h6>Email Id: {{$order->email}} </h6>
                                <h6>Phone: {{$order->phone}}</h6>
                                <h6>Address: {{$order->address}}</h6>
                            </div>
                        </div>
                        <br />
                        <h5>Order Items</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    @foreach ($order->orderItems as $orderItem)
                                        <tr>
                                            <td width="10%">{{$orderItem->id}}</td>
                                            <td width="10%">
                                                <img src="{{asset($orderItem->product->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="{{$orderItem->product->name}}">
                                            </td>
                                            <td>
                                                {{$orderItem->product->name}}
                                            </td>
                                            <td width="10%">${{$orderItem->price}}</td>
                                            <td width="10%">{{$orderItem->quantity}}</td>
                                            <td width="10%" class="fw-bold">${{$orderItem->quantity * $orderItem->price}}</td>
                                            @php
                                                 $totalPrice += $orderItem->quantity * $orderItem->price;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="fw-bold">Total Amount</td>
                                        <td colspan="1" class="fw-bold">${{$totalPrice}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection 