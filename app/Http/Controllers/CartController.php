<?php

namespace App\Http\Controllers;

use App\Events\BookingEvent;
use App\Jobs\DeleteBooking;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Booking;
use App\Models\Checkout;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;



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

    // public function booking($amount){
    //     if(session()->has('cart')){
    //         $cart = new Cart(session()->get('cart'));
    //     }else{
    //         $cart = null;
    //     }
    //     return view('checkout',compact('amount','cart'));
    // }

    public function booking($amount){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = null;
        }
        return view('checkout',compact('amount','cart'));
    }

    public function charge(Booking $booking, Request $request, Checkout $checkout){

        if($booking->isRegistered) {
            $request->session()->flash('error', "You already registered.");
            return redirect(route('order'));
        }

        // return $request->all();
        // if(session()->has('cart')){
        //     $cart = new Cart(session()->get('cart'));
        // }else{
        //     $cart = null;
        // }

        // $checkout = auth()->user()->bookings()->create([

        //         'cart'=>serialize(session()->get('cart'))
        //     ]);
        // $checkout = ($request->session())->get('cart');
        // $checkout = unserialize($checkout);
        // dd($checkout);
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['booking_id'] = $request->id;
        $data['cart'] = serialize(session()->get('cart'));
        $data['is_paid'] = 0;
        Booking::create($data);
        // Checkout::create($data);
        // $checkout = Booking::create($data);
        // dd($checkout);
        // $checkout = Booking::create([
        //     'user_id' => Auth::id(),
        //     'cart' => serialize(session()->get('cart')),
        //     'amount' => $amount,
        //     'is_paid' => 0,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);
        // dd($checkout);
        // dd($data['_token']);

        // // update user data
        // $user = Auth::user();
        // $user->name = $data['name'];

        // $user->save();

        // auth()->user()->bookings()->create([

        //     'cart'=>serialize(session()->get('cart'))
        // ]);

        // create Booking
        // Booking::create($data);



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
        // dd($carts);
        $cekStatus = Booking::where('user_id', auth()->user()->id)->first();
        // dd($cekStatus->is_paid);
        // dd($cekStatus);
        // dd($cekStatus->id);

        // if ($cekStatus->is_paid == false) {
        //     // event(new BookingEvent($cekStatus));
        // }

        // dispatch(new DeleteBooking($cekStatus));

        if ($cekStatus != null) {
            DeleteBooking::dispatch($cekStatus)->delay(now()->addMinutes(1));

            $now = Carbon::now();
            $twoDayFromNow = Carbon::now()->addDays(2);
            $modified = $twoDayFromNow;
            // dd($modified);
            return view('booking',compact('carts', 'cekStatus', 'modified'));
            // return view('booking',compact('carts', 'modified'));
        }

        return view('booking',compact('carts', 'cekStatus'));
        // return view('booking',compact('carts'));
    }

    public function destroy(Booking $booking){
        $booking = Booking::where('user_id', auth()->user()->id)->first();
        $booking->delete();
        return redirect()->back();
    }

    public function userOrders() {
        $bookings = Booking::latest()->get();
        $cekStatus = Booking::where('user_id', auth()->user()->id)->first();

        return view('admin.order.index',compact('bookings', 'cekStatus'));
    }

    public function viewUserOrders($userid, $bookingid) {
        $user = User::find($userid);
        $bookings = $user->bookings->where('id', $bookingid);
        // dd($bookings);
        $carts =$bookings->transform(function($cart,$key){
            return unserialize($cart->cart);
        });
        // $cekStatus = Booking::where('user_id', $user->id)->first();
        $cekStatus = Booking::where('user_id', $user->id)->first();


        return view('admin.order.show',compact('carts', 'cekStatus'));
    }

    public function checkoutUpdate(Request $request, $id) {
        $booking = Booking::find($id);
        $booking->is_paid = true;
        $booking->save();
        return redirect()->back();
    }



}