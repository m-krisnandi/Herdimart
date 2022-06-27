<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class FrontProductListController extends Controller
{
    public function index(Request $request)
    {
        // if($request->search) {
            // $products = Product::where('name', 'like', '%' . $request->search . '%')->paginate(10);
            $products = Product::when($request->search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', $search = "%{$search}%");
                    });
            })->when($request->category && $request->category != 'all', function ($query) use ($request) {
                return $query->whereHas('category', function ($query) use ($request) {
                    $query->where('slug', $request->category);
                });
            })->orderBy('created_at')->paginate(5);
            // return view('product', compact('products'));
        // }
        $productst = Product::latest()->limit(4)->get();
        $productCategories = ProductCategory::all();
        if($request->category) {
            $products = Product::where('category_id', $request->category)->paginate(10);
            return view('product', compact('products', 'productCategories'));
        }

        return view('product', compact('products', 'productst', 'productCategories'));
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