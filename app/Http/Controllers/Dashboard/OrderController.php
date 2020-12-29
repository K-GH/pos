<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {


       $orders = Order::when($request->status,function($q) use($request){

            return $q->where('status',$request->status);

        })->when($request->payment_id,function($q) use($request){

            return $q->where('payment_id',$request->payment_id);

        })->when($request->is_deposited,function($q) use($request){

            return $q->where('is_deposited',$request->is_deposited);

        })->latest()->paginate(5);
         //dd($orders);
        return view('dashboard.orders.index',compact('orders'));
    }
}
