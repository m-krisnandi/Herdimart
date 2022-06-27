<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','cart', 'is_paid'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function getIsRegisteredAttribute() {
        if(!Auth::check()) {
            return false;
        }
        return Booking::whereId($this->id)->whereUserId(Auth::id())->exists();
    }

    // public function Booking()
    // {
    //     return $this->belongsTo(Booking::class);
    // }
}