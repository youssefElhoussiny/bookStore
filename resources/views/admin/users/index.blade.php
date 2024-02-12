@extends('theme.default')
@section('head')
     <!-- Custom styles for this page -->
     <link href="{{asset('theme/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('heading')
عرض المستخدمين
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
             <thead> 
                <tr>
                    <th>الاسم</th>
                    <th>البريد الالكتروني</th>
                    <th>نوع المستخدم</th>
                    <th>الخيارات</th>
                </tr>
             </thead>
             <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->isSuperAdmin()? 'مدير عام' : ($user->isAdmin() ? 'مدير' : 'مستخدم')}}</td>   
                        <td>
                            <form action="{{route('users.update',$user)}}" method="post" class="ml-4 form-inline" style="display:inline-block">
                                @method('PATCH')
                                @csrf
                                <select name="adminstration_level" id="" class="form-control form-control-sm">
                                    <option  selected disabled>اخترا نوعا</option>
                                    <option value="0">مستخدم</option>
                                    <option value="1">مدير</option>
                                    <option value="2">مدير عام</option>
                                </select>
                                <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-edit"></i> تعديل</button>
                            </form>
                            <form action="{{route('users.destroy',$user)}}" method="post" style="display:inline-block">
                                @method('DELETE')
                                @csrf
                                @if (auth()->user() != $user)
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('هل انت متأكد؟')">
                                    <i class="fa fa-trash"></i> حذف</button>
                                @else
                                     <div class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>حذف</div>
                                @endif
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