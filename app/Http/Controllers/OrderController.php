<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request){
        $validation = $request->validate([
            'address' => 'required|exists:user_addresses,id',
            'product' => 'required|array',
            'product.*.id' => 'required|numeric|exists:products,id',
            'product.*.qty' => 'required|numeric|min:1',
            'items' => 'required|array',
            'items.*' => 'required|numeric|exists:cart_items,id',
            'total' => 'required|numeric'
        ]);
        $subTotal = 0;
        foreach($request->product as $product){
            $price = Product::where('id' , $product['id'])->value('price');
            $subTotal = $subTotal + ($price * $product['qty']);
        }
        if($subTotal < 100){
            $shipping = $subTotal * 0.1;
        } else {
            $shipping = 9.99;
        }
        $total = $subTotal + $shipping;
        if($total == $request->total){
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'user_address_id' => $request->address,
                'Total' => $total
            ]);
            foreach($request->product as $product){
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['qty'],
                ]);
            }
            foreach($request->items as $item){
                $cartItem = CartItem::find($item);
                if($cartItem){
                    $cartItem->delete();
                }
            }
            $status = OrderStatus::create([
                'order_id' => $order->id,
                'status' => 'Pending',
                'description' => 'Order recieved. Waiting for confirmation'
            ]);
            return redirect('/user?section=my-orders');
        }
        }
        public function update(Request $request , $id)
        {
            if(Auth::user()->is_admin){
                $order = Order::find($id);
                if($order){
                    switch($request->status){
                        case "Confirm":
                            $order->status->update([
                                'status' => 'Confirmed',
                                'description' => 'Your order has been confirmed. Please wait while we pack it and ship it to your address.'
                            ]);
                            return redirect()->back();

                        case "Complete":
                            $order->status->update([
                                'status' => 'Delivered',
                                'description' => 'Check your front door! Thank you for using PCParadise'
                            ]);
                            return redirect()->back();
                    }
                }
            } else {
                return redirect()->route('home')->with('Error' , "You do not have permission to complete this action.");
            }
        }

        public function destroy(Request $request ,$id)
    {
        if(Auth::user()->is_admin){
            $order = Order::find($id);
            if(!$order){
                return redirect()->back()->with('Error',"Order Not Found");
            }
            $order->status->update([
                'status' => 'Cancelled',
                'description' => 'Order Cancelled by Admin'
            ]);
            return redirect()->back();
        } elseif (!Auth::user()->is_admin){
            $pass = $request->validate([
                'password' => 'required|current_password'
            ]);
            $order = Order::find($id);
            if(!$order){
                return redirect()->back()->with('notfound',"Not Found");
            } elseif($order->user_id != Auth::user()->id){
                return redirect()->back()->with('Error' , "You do not have permission to complete this action.");
            }
            $order->status->update([
                'status' => 'Cancelled',
                'description' => 'Order Cancelled by user'
            ]);
            return redirect()->back();
        }
        
        
        

    }
    }

