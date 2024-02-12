@extends('theme.default')
@section('head')
     <!-- Custom styles for this page -->
     <link href="{{asset('theme/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('heading')
عرض المؤلفين
@endsection
@section('content')
<a href="{{route('authors.create')}}" class="btn btn-primary">
    <i class="fas fa-plus"></i>
اضافة مؤلف
</a>
<hr>
<div class="row">
    <div class="col-md-12">
        <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
             <thead> 
                <tr>
                    <th>الاسم</th>
                    <th>الوصف</th>
                    <th>الخيارات</th>
                </tr>
             </thead>
             <tbody>
                @foreach ($authors as $author)
                    <tr>
                        <td>{{$author->name}}</td>
                        <td>{{$author->description??'-'}}</td>
   
                        <td>
                            <a href="{{route('authors.edit',$author)}}" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                                تعديل
                            </a>
                            <form action="{{route('authors.destroy' , $author)}}" method="post" class="d-inline-block">
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