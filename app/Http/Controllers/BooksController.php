<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    use ImageUploadTrait;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('admin.books.create', compact('authors','categories','publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>"required",
            'isbn'=>['required','alpha_num',Rule::unique('books','isbn')],
            'cover_image'=>"required|image",
            'category'=>"nullable",
            'authors'=>"nullable",
            'publisher'=>"nullable",
            'description'=>"nullable",
            'publish_year'=>"numeric|nullable",
            'number_of_pages'=>"numeric|required",
            'number_of_copies'=>"numeric|required",
            'price'=>"numeric|required",
        ]);
        $book = new Book;

        $book->title=$request->title;
        $book->cover_image=$this->uploadImage($request->cover_image);
        $book->isbn=$request->isbn;
        $book->category_id = $request->category;
        $book->publisher_id = $request->publisher;
        $book->description = $request->description;
        $book->publish_year = $request->publish_year;
        $book->number_of_pages = $request->number_of_pages;
        $book->number_of_copies = $request->number_of_copies;
        $book->price = $request->price;

        $book->save();
        $book->authors()->attach($request->authors);

        session()->flash('flash_message','تمت اضافة الكتاب بنجاح');
        return redirect(route('books.show',$book));
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('admin.books.show',compact("book"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('admin.books.edit', compact('authors','categories','publishers','book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request,[
            'title'=>"required",
            'isbn'=>"required|numeric",
            'cover_image'=>"image",
            'category'=>"nullable",
            'authors'=>"nullable",
            'publisher'=>"nullable",
            'description'=>"nullable",
            'publish_year'=>"numeric|nullable",
            'number_of_pages'=>"numeric|required",
            'number_of_copies'=>"numeric|required",
            'price'=>"numeric|required",
        ]);
        if($book->isbn != $request->isbn)
        {
            request()->validate([
                'isbn'=>Rule::unique('books','isbn')
            ]);
        }
        
        $book->title=$request->title;
        if($request->has('cover_image'))
        {
            Storage::disk('public')->delete($book->cover_image);
            $book->cover_image=$this->uploadImage($request->cover_image);
        }
        $book->isbn=$request->isbn;
        $book->category_id = $request->category;
        $book->publisher_id = $request->publisher;
        $book->description = $request->description;
        $book->publish_year = $request->publish_year;
        $book->number_of_pages = $request->number_of_pages;
        $book->number_of_copies = $request->number_of_copies;
        $book->price = $request->price;

        // if($book->isDirty('isbn'))
        // {
        //     $this->validate($request,[
        //         'isbn'=>['required','alpha_num',Rule::unique('books','isbn')],
        //     ]);
        // }
        

        $book->save();
        $book->authors()->detach();
        $book->authors()->attach($request->authors);

        session()->flash('flash_message','تم تعديل الكتاب بنجاح');
        return redirect(route('books.show',$book));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        Storage::disk('public')->delete($book->cover_image);
        $book->delete();
        session()->flash('flash_message','تم حذف الكتاب بنجاح');
        return redirect(route('books.index'));
    }
    public function details(Book $book)
    {
        return view('books.details', compact("book"));
    }
    public function rate(Request $request , Book $book)
    {
        if(auth()->user()->rated($book))
        {
            $rating = Rating::where(['user_id' => auth()->id() , 'book_id' => $book->id ])->first();
            $rating->value = $request->value;
            $rating->save();
        }else{
            $rating = new Rating;
            $rating->user_id = auth()->id();
            $rating->book_id = $book->id ;
            $rating->value = $request->value;
            $rating->save();
        }
        return back();
    }
}
