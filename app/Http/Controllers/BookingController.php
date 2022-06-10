<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index() {
        $checkouts = Booking::with('user')->whereUserId(Auth::id())->get();
        return view('booking', [
            'checkouts' => $checkouts
        ]);
    }
}
