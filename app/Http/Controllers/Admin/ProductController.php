<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::withTrashed()->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating new Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get()->pluck('name','id');
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'category_ids'  => 'required'
        ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator->errors()->all());
        }
        $data = $request->except(['image']);
        $product = Product::create($data);
        if($request->category_ids){
            foreach($request->category_ids as $category_id){
                ProductCategory::create(array('category_id'=>$category_id,'product_id'=>$product->id));
            }
        }
        if($request->has('image'))
        {
            $file = $request->image;
            $target_dir = "images/";
            $extension = $file->getClientOriginalExtension();
            $filename = rand(100000, 999999).time(). ".".$extension;
            if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif" ) {
                return redirect('/')->with('error',trans("Sorry, only JPG, JPEG, PNG & GIF files are allowed."));
            }
            Storage::disk('public')->put($target_dir.$filename, file_get_contents($file), 'public');
            $product->image = $filename;
        }
        $product->save();
        return redirect()->route('admin.product.index');
    }


    /**
     * Show the form for editing Product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category_ids = ProductCategory::where('product_id',$id)->pluck('category_id')->toArray();
        $categories = Category::get()->pluck('name','id');
        return view('admin.product.edit', compact('product','categories','category_ids'));
    }

    /**
     * Update Product in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'category_ids'  => 'required'
        ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator->errors()->all());
        }
        $product = Product::findOrFail($id);
        $product->update($request->except(['image']));
        if($request->category_ids){
            ProductCategory::where('product_id',$product->id)->delete();
            foreach($request->category_ids as $category_id){
                ProductCategory::create(array('category_id'=>$category_id,'product_id'=>$product->id));
            }
        }
        if($request->has('image'))
        {
            if(@$product->image){@unlink(Storage::disk('public')->url('images/'.$product->image));}
            $file = $request->image;
            $target_dir = "images/";
            $extension = $file->getClientOriginalExtension();
            $filename = rand(100000, 999999).time(). ".".$extension;
            if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif" ) {
                return redirect('/')->with('error',trans("Sorry, only JPG, JPEG, PNG & GIF files are allowed."));
            }
            Storage::disk('public')->put($target_dir.$filename, file_get_contents($file), 'public');
            $product->image = $filename;
        }
        $product->save();
        return redirect()->route('admin.product.index');
    }


    /**
     * Remove Product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.product.index');
    }

    /**
     * Display User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Restore User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        Product::withTrashed()->find($id)->restore();
        return redirect()->route('admin.product.index');
    }

    //delete media
    public function removeMedia(Request $request)
    {
        $product = Product::find($request->id);
        if($product->image){@unlink(Storage::disk('public')->url('images/'.$product->image));}
        $product->image = '';
        $product->save();
        return 1;
    }
}
