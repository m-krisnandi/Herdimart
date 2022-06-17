<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class FrontProductListController extends Controller
{
    public function index(Request $request)
    {
        if($request->search) {
            $products = Product::where('name', 'like', '%' . $request->search . '%')->paginate(10);
            return view('product', compact('products'));
        }
        $products = Product::latest()->limit(5)->get();
        $productCategories = ProductCategory::all();
        if($request->category) {
            $products = Product::where('category_id', $request->category)->paginate(10);
            return view('product', compact('products', 'productCategories'));
        }

        return view('product', compact('products', 'productCategories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('product-detail', compact('product'));
    }

    // public function search(Request $request)
    // {
    //     $search = $request->search;
    //     $products = Product::where('name', 'like', '%' . $search . '%')->get();
    //     return view('product', compact('products'));
    // }

    public function category ($slug, Request $request) {
        dd($request->all());
        // $categories = ProductCategory::where('slug', $slug)->first();
        if($request->categories) {
            $products = $this->filterProducts($request);
        }
        // $products = Product::where('category_id', $category->id)->get();
        return view('product', compact('products','categories','slug','filterSubCategories'));
    }

    public function filterProducts(Request $request)
    {
        $categoryId = [];
        $categories = ProductCategory::where('id', $request->categories)->get();
        foreach ($categories as $category) {
            array_push($categoryId, $category->id);
        }

        $products = Product::whereIn('category_id', $categoryId)->get();
        return $products;
    }


}