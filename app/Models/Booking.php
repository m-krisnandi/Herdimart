<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id','user_id','cart', 'is_paid'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    // public function Booking()
    // {
    //     return $this->belongsTo(Booking::class);
    // }
}
