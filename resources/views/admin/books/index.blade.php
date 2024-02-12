@extends('theme.default')
@section('head')
     <!-- Custom styles for this page -->
     <link href="{{asset('theme/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('heading')
عرض الكتب
@endsection
@section('content')
<a href="{{route('books.create')}}" class="btn btn-primary">
    <i class="fas fa-plus"></i>
اضافة كتاب
</a>
<hr>
<div class="row">
    <div class="col-md-12">
        <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
             <thead> 
                <tr>
                    <th>العنوان</th>
                    <th>الرقم التسلسلي</th>
                    <th>التصنيف</th>
                    <th>المؤلفون</th>
                    <th>الناشرون</th>
                    <th>السعر</th>
                    <th>الخيارات</th>
                </tr>
             </thead>
             <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td><a href="{{route('books.show',$book)}}">{{$book->title}}</a></td>
                        <td><a href="#">{{$book->isbn??'-'}}</a></td>
                        <td><a href="#">{{$book->category->name??'-'}}</a></td>
                        <td>
                            @if ($book->authors()->count())
                                @foreach ($book->authors as $author) 
                                    {{$loop->first?'':'و'}}  
                                    {{$author->name}}
                                @endforeach
                            @endif
                        </td>
                        <td><a href="#">{{$book->publisher->name??'-'}}</a></td>
                        <td><a href="#">{{$book->price}} $</a></td>
                        <td>
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
                        </td>
                    </tr>
                @endforeach
             </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
    <!-- Page level plugins -->
    <script src="{{asset('theme/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#books-table').DataTable({
                "language":{
                    "url":"//cdn.datatables.net/plug-ins/1.13.7/i18n/ar.json"
                }
            });
        });
    </script>
@endsection