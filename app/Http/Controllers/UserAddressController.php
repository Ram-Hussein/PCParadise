<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'Name'=>'required|string',
            'StreetAddress'=>'required|string',
            'City'=>'required|string',
            'State'=>'required|string',
            'PostalCode'=>'required||min:5|alpha_num',
        ]);
        
        $UserAddress = UserAddress::create([
            'user_id'=> Auth::user()->id,
            'Name'=> $request->Name,
            'StreetAddress'=> $request->StreetAddress,
            'City'=> $request->City,
            'State'=> $request->State,
            'PostalCode'=> $request->PostalCode,
        ]);
        return redirect()->back();

    }

    public function update(Request $request, $id)
    {
        $UserAddress = UserAddress::find($id);
        if(!$UserAddress){
            return redirect()->back()->with('notfound',"Not Found");
        } elseif($UserAddress->user_id != Auth::user()->id){
            return redirect()->back()->with('unauthorized',"Unauthorized Action");
        }
        $request->validate([
            'Name'=>'required|string',
            'StreetAddress'=>'required|string',
            'City'=>'required|string',
            'State'=>'required|string',
            'PostalCode'=>'required||min:5|alpha_num',
        ]);
        $UserAddress->update([
            'Name'=>$request->Name,
            'StreetAddress'=>$request->StreetAddress,
            'City'=>$request->City,
            'State'=>$request->State,
            'PostalCode'=>$request->PostalCode,
        ]);
        return redirect()->back();


    }

    public function destroy(Request $request ,$id)
    {
        $pass = $request->validate([
            'password' => 'required|current_password'
        ]);
        $UserAddress = UserAddress::find($id);
        if(!$UserAddress){
            return redirect()->back()->with('notfound',"Not Found");
        } elseif($UserAddress->user_id != Auth::user()->id){
            return redirect()->back()->with('unauthorized',"Unauthorized Action");
        }
        $UserAddress->delete();
        return redirect()->back();

    }
}   
