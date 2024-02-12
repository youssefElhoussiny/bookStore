<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string',
        ]);
        $category = new Category;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();
        session()->flash('flash_message',"تمت اضافة التصنيف بنجاح");
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name'=>'required|string',
        ]);
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();
        session()->flash('flash_message',"تم تعديل التصنيف بنجاح");
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('flash_message',"تم حذف التصنيف بنجاح");
        return redirect(route('categories.index'));
    }
    public function result(Category $category)
    {
        $books=$category->books()->paginate(12);
        $title="الكتب التابعة للتصنيف :".$category->name;
        return view('gallery',compact('books','title'));
    }
    public function list()
    {
        $categories=Category::all()->sortBy('name');
        $title="التصنيفات";
        return view('categories.index',compact('categories','title'));
    }
    public function search(Request $request)
    {
        
        $categories=Category::where('name','like',"%{$request->term}%")->get()->sortBy('name');
        $title="نتائج البحث عن :".$request->term;
        return view('categories.index',compact('categories','title'));
    }
}
