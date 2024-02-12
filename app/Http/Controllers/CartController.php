<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addToCart(Request $request)
    {
        $book = Book::find($request->id);
        
        if(auth()->user()->booksInCart->contains($book)){
            $newQuantity = $request->quantity + auth()->user()->booksInCart()->where('book_id',$book->id)->first()->pivot->number_of_copies;
            if($newQuantity > $book->number_of_copies)
            {
                session()->flash('warning_message','لم تتم اضافة الكتاب لقد قمت بتجاوز عدد النسخ الموجودة لدينا , اقثى عدد موجود لدينا هو' . ($book->number_of_copies - auth()->user()->booksInCart()->where('book_id' , $book->id)->first()->pivot->number_of_copies) . "كتاب");
                return redirect()->back();
            }
            else
            {
                auth()->user()->booksInCart()->updateExistingPivot($book->id , ['number_of_copies'=> $newQuantity]);
            }
        }
        else
        {
            auth()->user()->booksInCart()->attach($request->id , ['number_of_copies' => $request->quantity ]);
        }
        $num_of_product = auth()->user()->booksInCart()->count();
        return response()->json(['num_of_product' => $num_of_product]);
    }
    public function viewCart()
    {
        $items = auth()->user()->booksInCart;
        return view('cart',compact('items'));
    }
    public function removeOne(Book $book)
    {
        $oldQuantity = auth()->user()->booksInCart()->where('book_id',$book->id)->first()->pivot->number_of_copies;
        if($oldQuantity > 1)
        {
            auth()->user()->booksInCart()->updateExistingPivot($book->id , ['number_of_copies'=> --$oldQuantity]);
        }else{
            auth()->user()->booksInCart()->detach($book->id);
        }
        return redirect()->back();
    }
    public function removeAll(Book $book)
    {
        auth()->user()->booksInCart()->detach($book->id);
        return redirect()->back();
    }

}
