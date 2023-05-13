@extends('layouts.admin')

@section('title', 'My Order')


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">   
                <h3>My Order
                  
                </h3>
            </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <label >Filter by Date</label>
                                    <input type="date" name="date"  value="{{Request::get('date') ?? date('Y-m-d') }}" class="form-control">
                                </div>
                                    <div class="col-md-3">
                                        <label>Filter by Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">Select Status</option>
                                            <option value="in progress {{Request::get('status') == 'in progress' ? 'selected':''}}">In Progress</option>
                                            <option value="completed {{Request::get('status') == 'completed' ? 'selected':''}}">Completed</option>
                                            <option value="pending {{Request::get('status') == 'pending' ? 'selected':''}}">Pending</option>
                                            <option value="cancelled {{Request::get('status') == 'cancelled' ? 'selected':''}}">Cancelled</option>
                                            <option value="out-for-delivery {{Request::get('status') == 'out-for-delivery' ? 'selected':''}}">Out for delivery</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                                
                              
                            
    
                        </form>
                    </div>
                     <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Tracking No</th>
                                        <th>Username</th>
                                        <th>Payment Mode</th>
                                        <th>Ordered Date</th>
                                        <th>Status Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->tracking_no }}</td>
                                            <td>{{$item->fullname}}</td>
                                            <td>{{$item->payment_mode}}</td>
                                            <td>{{$item->created_at->format('d-m-Y')}}</td>
                                            <td>{{$item->status_message}}</td>
                                            <td><a href="{{url('admin/order/'.$item->id)}}" class="btn btn-primary btn-sm">View</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No Orders available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{$orders->links()}}
                        </div>
                </div>
             </div>
             </div>
    </div>
</div>




@endsection