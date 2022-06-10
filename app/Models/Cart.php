<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items = [];
    public $totalQty;
    public $totalPrice;
    public $is_paid;

    public function __construct($cart=null){
        if($cart){
            $this->items = $cart->items;
            $this->totalQty = $cart->totalQty;
            $this->totalPrice = $cart->totalPrice;
        } else {
            $this->items = [];
            $this->totalQty = 0;
            $this->totalPrice = 0;
            $this->is_paid = false;
        }
    }

    public function add($product) {
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'price' => $product->price,
            'qty' => 0,
            'image' => $product->image
        ];
        if(!array_key_exists($product->id, $this->items)){
            $this->items[$product->id] = $item;
            $this->totalQty++;
            $this->totalPrice += $product->price;
        } else {
            $this->totalQty++;
            $this->totalPrice += $product->price;
        }
        $this->items[$product->id]['qty']++;
    }

    public function updateQty($id, $qty) {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price']*$this->items[$id]['qty'];
        //add the item with the new qty
        $this->items[$id]['qty'] = $qty;
        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['price']*$qty;
    }

    public function remove($id) {
        if(array_key_exists($id, $this->items)){
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['price']*$this->items[$id]['qty'];
            unset($this->items[$id]);
        }
    }
}