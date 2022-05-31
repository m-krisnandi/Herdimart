<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
      return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'image'=>'required|mimes:jpeg,png',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
            'category'=>'required'
         ]);
           $image = $request->file('image')->store('public/product');

           Product::create([

            'name'=>$request->name,
            'slug' => Str::slug($request->name),
            'image'=>$image,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'category_id'=>$request->category,
         ]);
         notify()->success('Product created successfully!');
         return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
      return view('admin.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $filename = $product->image;
        if($request->file('image')){
            $image = $request->file('image')->store('public/product');
            \Storage::delete($filename);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->image = $image;
        $product->price=$request->price;
        $product->stock=$request->stock;
        $product->category_id = $request->category;
        $product->save();
       }else{
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price=$request->price;
        $product->stock=$request->stock;
        $product->category_id = $request->category;

        $product->save();
    }
        notify()->success('Product updated successfully!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
      $filename = $product->image;
      $product->delete();
      \Storage::delete($filename);
      notify()->success('Product deleted successfully!');
      return redirect()->route('product.index');
    }
}