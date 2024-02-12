<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1
     $book1=  Book::create([
        'category_id'=>Category::where('name','ريادة الاعمال')->first()->id,
        'publisher_id'=>Publisher::where('name','اكاديمية حسوب')->first()->id,
        'title'=>"التوظيف عن بعد",
        'description'=>"هذا هو وصف كتاب التوظيف عن بعد",
        'number_of_copies'=>"300",
        'number_of_pages'=>"288",
        'price'=>'17',
        'isbn'=>'100000000000',
        'cover_image'=>'images/1.png',
     ]);
     $book1->authors()->attach(Author::where('name','فاطمة حبيشة')->first());
    //  2
    $book2=  Book::create([
        'category_id'=>Category::where('name','العمل الحر')->first()->id,
        'publisher_id'=>Publisher::where('name','اكاديمية حسوب')->first()->id,
        'title'=>"مدخل الى العمل الحر",
        'description'=>"هذا هو وصف كتاب مدخل الى العمل الحر",
        'number_of_copies'=>"400",
        'number_of_pages'=>"288",
        'price'=>'17',
        'isbn'=>'1000000000000',
        'cover_image'=>'images/2.png',
     ]);
     $book2->authors()->attach(Author::where('name','محمد عرابي')->first());
    //  3
    $book3=  Book::create([
        'category_id'=>Category::where('name','التصميم')->first()->id,
        'publisher_id'=>Publisher::where('name','اكاديمية حسوب')->first()->id,
        'title'=>"مدخل الى التصميم",
        'description'=>"هذا هو وصف كتاب التوظيف عن بعد",
        'number_of_copies'=>"300",
        'number_of_pages'=>"288",
        'price'=>'17',
        'isbn'=>'1000000000000',
        'cover_image'=>'images/3.png',
     ]);
     $book3->authors()->attach(Author::where('name','محمد الزاير')->first());
    //  4
    $book4=  Book::create([
        'category_id'=>Category::where('name','البرمجة')->first()->id,
        'publisher_id'=>Publisher::where('name','اكاديمية حسوب')->first()->id,
        'title'=>"مدخل الى البرمجة",
        'description'=>"هذا هو وصف كتاب التوظيف عن بعد",
        'number_of_copies'=>"300",
        'number_of_pages'=>"288",
        'price'=>'17',
        'isbn'=>'1000000000000',
        'cover_image'=>'images/4.png',
     ]);
     $book4->authors()->attach(Author::where('name','عمر النواوي')->first());
    //  
    $book5=  Book::create([
        'category_id'=>Category::where('name','ريادة الاعمال')->first()->id,
        'publisher_id'=>Publisher::where('name','اكاديمية حسوب')->first()->id,
        'title'=>"التوظيف عن بعد",
        'description'=>"هذا هو وصف كتاب التوظيف عن بعد",
        'number_of_copies'=>"300",
        'number_of_pages'=>"288",
        'price'=>'17',
        'isbn'=>'100000000000',
        'cover_image'=>'images/5.png',
     ]);
     $book5->authors()->attach(Author::where('name','فاطمة حبيشة')->first());
    //  
    $book6=  Book::create([
        'category_id'=>Category::where('name','ريادة الاعمال')->first()->id,
        'publisher_id'=>Publisher::where('name','اكاديمية حسوب')->first()->id,
        'title'=>"التوظيف عن بعد",
        'description'=>"هذا هو وصف كتاب التوظيف عن بعد",
        'number_of_copies'=>"300",
        'number_of_pages'=>"288",
        'price'=>'17',
        'isbn'=>'100000000000',
        'cover_image'=>'images/6.png',
     ]);
     $book6->authors()->attach(Author::where('name','فاطمة حبيشة')->first());
    
    }
}
