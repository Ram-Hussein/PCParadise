<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Order;
use App\Models\Product;
use App\Models\TempProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function admin($section)
{
    if(Auth::user()->is_admin){
        switch ($section) {
            case "overview":
                $orders = Order::orderBy('id', 'desc')->take(5)->get();
                $users = count(User::all());
                $products = Product::all();
                $pending = TempProduct::all();
                $shipped = Order::whereHas('status', function ($query) {
                    $query->where('status', 'Delivered');
                    })->get();
                $shipping = Order::whereHas('status', function ($query) {
                    $query->where('status', 'Pending')->orWhere('status' , 'Confirmed');
                    })->get();
                $revenue = 0;
                foreach (Order::all() as $order){
                    $revenue = $revenue + $order->Total ;
                }
                $data = [
                    'section' => $section,
                    'revenue' => $revenue,
                    'users' => $users,
                    'products' => $products,
                    'pending' => $pending,
                    'orders' => $orders,
                    'shipped' => count($shipped),
                    'shipping' => count($shipping),
                ];
                return view('admin.overview' , $data);
                break;
            case "products":
                return view('admin.products' , ['section' => $section]);
                break;
            case "orders":
                $orders = Order::all();

                $data = [
                    'section' => $section,
                    'orders' => $orders,
                ];
                return view('admin.orders' , $data);
            case "users":
                $users = User::all();
                $countries = Country::orderBy('name')->get();
                $data = [
                    'section' => $section,
                    'users' => $users,
                    'countries' => $countries,
                ];
                return view('admin.users', $data);
            default:
                // code to be executed if no case matches
        }
    } else {
        return redirect()->route('home')->with('Error' , "You do not have permission to complete this action."); 
    }
}
public function addUser(Request $request){
        $request->validate([
            'fname' => ['required', 'alpha', 'max:255'],
            'lname' => ['required', 'alpha', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'dob' => ['required', 'date', 'before:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'country' => ['required', 'exists:countries,id'],
            'PhoneNumber' => ['required', 'numeric', ],
        ]);
        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country_id' => $request->country,
            'date_of_birth' => $request->dob,
            'is_admin' => 0,
            'PhoneNumber' => $request->PhoneNumber,
        ]);
        if($request->has('admin') && $request->admin){
            $user->update([
                'is_admin' => 1
            ]);
        }
        return redirect()->back();

}
}
