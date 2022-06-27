<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Jobs\DeleteBooking;


class BookingController extends Controller
{
    // public function order(){

    //     $bookings = auth()->user()->bookings;
    //     $carts =$bookings->transform(function($cart,$key){
    //         return unserialize($cart->cart);
    //     });
    //     // dd($carts);
    //     $cekStatus = Booking::where('user_id', auth()->user()->id)->first();
    //     // dd($cekStatus->is_paid);
    //     // dd($cekStatus);
    //     // dd($cekStatus->id);

    //     // if ($cekStatus->is_paid == false) {
    //     //     // event(new BookingEvent($cekStatus));
    //     // }

    //     // dispatch(new DeleteBooking($cekStatus));

    //     if ($cekStatus != null) {
    //         DeleteBooking::dispatch($cekStatus)->delay(now()->addMinutes(1));

    //         $now = Carbon::now();
    //         $twoDayFromNow = Carbon::now()->addDays(2);
    //         $modified = $twoDayFromNow;
    //         // dd($modified);
    //         return view('booking',compact('carts', 'cekStatus', 'modified'));
    //         // return view('booking',compact('carts', 'modified'));
    //     }

    //     return view('booking',compact('carts', 'cekStatus'));
    //     // return view('booking',compact('carts'));
    // }

    public function index() {
        $carts = Booking::with('user')->whereUserId(Auth::id())->get();
        $cekStatus = Booking::where('user_id', Auth::id())->first();
        // dd($carts->toArray());
        // $booking = $carts->toArray();
        // dd($booking[0]['user']['name']);
        // dd($booking[]['cart']);
        $carts =$carts->transform(function($cart,$key){
            return unserialize($cart->cart);
        });

        if ($cekStatus != null) {
            DeleteBooking::dispatch($cekStatus)->delay(now()->addMinutes(1));

            $now = Carbon::now();
            $twoDayFromNow = Carbon::now()->addDays(2);
            // $twoDayFromNow = Carbon::now()->addMinutes(1);
            $modified = $twoDayFromNow;
            // dd($modified);
            return view('booking',compact('carts', 'cekStatus', 'modified'));
            // return view('booking',compact('carts', 'modified'));
        }
        // dd($carts);
        return view('booking',compact('carts', 'cekStatus'));
        // return view('booking', [
        //     'carts' => $carts
        // ]);

    }
}