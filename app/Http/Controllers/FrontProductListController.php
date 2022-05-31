<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontProductListController extends Controller
{
    public function index()
    {
        $products = Product::latest()->limit(5)->get();
        return view('product', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('product-detail', compact('product'));
    }
}