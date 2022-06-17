<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductCategory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'price',
        // 'stock',
        'category_id',
    ];

    public function category(){
    	return $this->hasOne(ProductCategory::class,'id','category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}