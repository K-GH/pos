<?php

namespace App\Http\Controllers\Dashboard\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Client;
use App\Order;
use App\Category;
use App\Product;

class OrderController extends Controller
{
    public function index()
    {

    }

    public function create(Client $client)
    {
        $categories=Category::with('products')->get();
        return view('dashboard.clients.orders.create',compact('client','categories'));
    }
    public function store(Request $request , Client $client)
    {
       //dd($request->all());

       $request->validate([
           'product_ids'=>'required|array',
          // 'quanities'=>'required|array',
       ]);

       //create order table
       $order=$client->orders()->create([]);

       //best solution without loop
       //create on product_order
       $order->products()->attach($request->product_ids);
       $total_price =0;
       foreach ($request->product_ids as $id=>$quantity) {

       // dd($quanity,$id);

           //get product with product_id
            $product=Product::FindOrFail($id);
            // calculate total and calculate products quanities 
            $total_price += $product->sale_price  * $quantity['quantity'];


            //update stock
            $product->update([
                'stock'=> $product->stock - $quantity['quantity'],
            ]);
       }

       //update total_price 
       $order->update([
           'total_price'=>$total_price,
       ]);


  /*   
        //first solution 
       //create on product_order
       $total_price =0;
       foreach ($request->product_ids as $index=>$product_id) {

            //get product with product_id
            $product=Product::FindOrFail($product_id);
            // calculate total and calculate products quanities 
            $total_price += $product->sale_price * $request->quanities[$index];
            //save
            $order->products()->attach($product_id,['quantity'=> $request->quanities[$index]]);

            //update stock
            $product->update([
                'stock'=> $product->stock - $request->quanities[$index],
            ]);
       }

       //update total_price 
       $order->update([
           'total_price'=>$total_price,
       ]);
    */
        
    }

    public function edit(Client $client , Order $order)
    {
        
    }
    public function update( Request $request , Client $client , Order $order)
    {
        
    }

    public function destroy( Client $client , Order $order)
    {
        
    }
}
