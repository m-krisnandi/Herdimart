<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Booking;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Product $product){
    	//return $product;

        if(session()->has('cart')){
    		$cart = new Cart(session()->get('cart'));
    	}else{
    		$cart = new Cart();
    	}
    	$cart->add($product);
        // dd($cart);

    	session()->put('cart',$cart);
    	//  notify()->success('Product added to cart!');
        return redirect()->back();

    }

    public function showCart(){

        if(session()->has('cart')){
    		$cart = new Cart(session()->get('cart'));
    	}else{
    		$cart = null;
    	}
        // dd($cart->items);
        return view('cart',compact('cart'));
    }

    public function updateCart(Product $product,Request $request){
        $request->validate([
            'qty' => 'required|numeric|min:1'
        ]);
        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product->id,$request->qty);
        session()->put('cart',$cart);
        // notify()->success('Product updated to cart!');
        return redirect()->back();
    }

    public function removeCart(Product $product){
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);
        if($cart->totalQty == 0){
            session()->forget('cart');
        } else {
            session()->put('cart',$cart);
        }
        // notify()->success('Product removed from cart!');
        return redirect()->back();
    }

    public function booking($amount){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = null;
        }
        return view('checkout',compact('amount','cart'));
    }

    public function charge(Request $request){

        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = null;
        }

            auth()->user()->bookings->create([

                'cart'=>serialize(session()->get('cart')),
                'is_paid'=>false,
            ]);


            session()->forget('cart');
            // notify()->success(' Transaction completed!');
            return redirect()->to('/');
    }

    //for loggedin user
    public function order(){

        $bookings = auth()->user()->bookings;
        $carts =$bookings->transform(function($cart,$key){
            return unserialize($cart->cart);
        });
        dd($carts);
        // return view('booking',compact('carts'));

    }


}
