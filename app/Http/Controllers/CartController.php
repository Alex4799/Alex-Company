<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //addCart
    public function addCart($id){
        $data=$this->changeData($id);
        Cart::create($data);
        return redirect()->route('customer#home')->with(['createSucc'=>'Product is added to cart']);
    }

    // cartList
    public function cartList(){
        $cart=Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image1 as product_image')
        ->leftJoin('products','carts.product_id','products.id')
        ->where('user_id',Auth::user()->id)
        ->get();
        $total=0;
        foreach ($cart as $c) {
            $total+= $c->product_price*$c->qty;
        }
        return view('customer.cart.cart',compact('cart','total'));
    }

    //remove
    public function remove(Request $req){
        Cart::where('id',$req->cart_id)->delete();
    }

    //removeAll
    public function removeAll(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // private function
    private function changeData($id){
        return [
            'user_id'=>Auth::user()->id,
            'product_id'=>$id,
        ];
    }
}
