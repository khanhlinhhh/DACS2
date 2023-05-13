<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        // $todayDate = Carbon::now();
        // $orders = Order::whereDate('created_at',$todayDate)->paginate(5);
        $todayDate = Carbon::now()->format('Y-m-d'); 
        $orders = Order::when($request->date != null, function ($q) use ($request) {
                            return  $q->whereDate('created_at',$request->date);
                         
                        }, function ($q) use ($todayDate) {
                            return $q->whereDate('created_at',$todayDate);
                        })
                        ->when($request->status != null, function ($q) use ($request) {
                            
                            return  $q->where('status_message',$request->status);
                        })
                        ->paginate(5);

        return view('admin.order.index', compact('orders'));
    }

    public function show(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if($order)
        {
            return view('admin.order.view', compact('order'));
        }else
        {
             return redirect()>back()->with('message','No Order Found');
        }
    }
    // public function serch(Request $request)
    // {

    //     $fromDate = $request->fromDate;
    //     $toDate = $request->toDate;
    //    $orders = DB::select("SELECT * FROM orders WHERE created_at BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59' ");
    //     return view('admin.order.index', compact('orders'));
    // }
}
