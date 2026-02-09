<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartItemController extends Controller
{
    //
    public function index(){
        $cartItems = CartItem::where('user_id' , auth()->user()->id)->get();
        $addresses = Auth::user()->addresses;
        return view('cart' , [
            'cartItems' => $cartItems,
            'addresses' => $addresses
        ]);

    }




    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $cartItem = CartItem::create([
            'user_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
        ]);

        $cartItems = CartItem::where('user_id', auth()->id())->get();
        config(['cartItems' => $cartItems]);
        return redirect()->route('cart');

        
    }


    public function destroy($id)
    {
        $cartItem = CartItem::find($id);
        if(!$cartItem){
            return redirect()->back()->with('notfound',"Not Found");
        } elseif($cartItem->user_id != Auth::user()->id){
            return redirect()->back()->with('unauthorized',"Unauthorized Action");
        }
        $cartItem->delete();
        return redirect()->back();

    }
}
