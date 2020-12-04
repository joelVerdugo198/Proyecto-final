<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->hasPermissionTo('crud categories')) {

            $categories = Category::all();

            return view('categories.index', compact('categories'));
            
        }else{
            return redirect()->back()->with('error','Do not have permission');
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($category = Category::create($request->all())) {

            return redirect()->back()->with('success','The record was created successfully');
        }
        return redirect()->back()->with('error','The record could not be created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = Category::find($request->id);
        if ($category) {
            if ($category->update($request->all())) {
                return redirect()->back()->with('success','The record was updated successfully');;
            }
        }
        return redirect()->back()->with('error','Could not update the record');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category) {

            if ($category->delete()) {
                return response()->json([
                'message' => 'Record removed successfully',
                 'code' => '200'
                ]);
            }
            return response()->json([
                'message' => 'Could not delete the record',
                 'code' => '400'
            ]);
        }
    }
}
