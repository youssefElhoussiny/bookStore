@extends('theme.default')
@section('heading')
    عرض تفاصيل الكتاب
@endsection
@section('head')
    <style>
        table
        {
            table-layout: fixed;
        }
        table tr th
        {
            width: 30%;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        عرض تفاصيل الكتاب
                    </div>
                    <div class="card-body">
                        <table class="table table-stribed">
                            <tr>
                                <th>العنوان</th>
                                <td class="lead"><b>{{$book->title}}</b></td>
                            </tr>
                            @if ($book->isbn)
                                <tr>
                                    <th>الرقم التسلسلي</th>
                                    <td>{{$book->isbn}}</td>
                                </tr>
                            @endif
                            <tr>
                                <th>صورة الغلاف</th>
                                <td>
                                    <img src="{{asset('storage/'.$book->cover_image)}}" alt="" class="img-fluid img-thumbnail">
                                </td>
                            </tr>
                            @if ($book->category)
                                <tr>
                                    <th>تصنيف الكتاب</th>
                                    <td>{{$book->category->name}}</td>
                                </tr>
                                
                            @endif
                            @if ($book->authors()->count())
                                <tr>
                                    <th>المؤلفون</th>
                                    <td>
                                        @foreach ($book->authors as $author)
                                            {{$loop->first?'':'و'}}
                                            {{$author->name}}
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                            @if ($book->publisher)
                            <tr>
                                <th>الناشر</th>
                                <td>{{$book->publisher->name}}</td>
                            </tr>
                                
                            @endif
                            @if ($book->description)
                                <tr>
                                    <th>الوصف</th>
                                    <td>{{$book->description}}</td>
                                </tr>
                                
                            @endif
                            @if ($book->publish_year)
                            <tr>
                                <th>سنة النشر</th>
                                <td>{{$book->publish_year}}</td>
                            </tr>
                            
                        @endif
                        <tr>
                            <th>عدد الصفحات</th>
                            <td>{{$book->number_of_pages}}</td>
                        </tr>
                        <tr>
                            <th>عدد النسخ</th>
                            <td>{{$book->number_of_copies}}</td>
                        </tr>
                        <tr>
                            <th>السعر</th>
                            <td>{{$book->price}} $</td>
                        </tr>
                        
                        </table>
                        <a href="{{route('books.edit',$book)}}" class="btn btn-info btn-sm">
                            <i class="fa fa-edit"></i>
                            تعديل
                        </a>
                        <form action="{{route('books.destroy' , $book)}}" method="post" class="d-inline-block">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل انت متأكد')">
                                <i class="fa fa-trash"></i>
                                حذف
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection