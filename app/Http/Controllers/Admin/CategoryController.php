<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withTrashed()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get()->pluck('name','id')->prepend(trans('quickadmin.qa_please_select'), '');
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created Category in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required'
        ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator->errors()->all());
        }
        $data = $request->all();
        $category = Category::create($data);
        return redirect()->route('admin.category.index');
    }


    /**
     * Show the form for editing Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::get()->pluck('name','id')->prepend(trans('quickadmin.qa_please_select'), '');
        return view('admin.category.edit', compact('category','categories'));
    }

    /**
     * Update Category in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required'
        ]);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator->errors()->all());
        }
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.category.index');
    }

    /**
     * Display User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.show', compact('category'));
    }

    /**
     * Restore User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        Category::withTrashed()->find($id)->restore();
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        //reference removing
        Category::where('parent_category_id',$id)->update(['parent_category_id'=>null]);
        return redirect()->route('admin.category.index');
    }
}
