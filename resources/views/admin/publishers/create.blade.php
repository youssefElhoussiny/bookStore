@extends('theme.default')
@section('heading')
    اضافة ناشرا جديد
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="card mb-4 col-md-8">
            <div class="card-header text-center">
                اضف ناشرا جديدا
            </div>
            <div class="card-body">
                <form action="{{ route('publishers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">اسم الناشر</label>
                        <div class="col-md-6">
                            <input id="name" type="text"
                                class="form-control @error('name')
                                is-invaild
                            @enderror"
                                name="name" value="{{ old('name') }}" autocomplete="name" />
                            @error('name')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">العنوان</label>
                        <div class="col-md-6">
                            <textarea id="address" type="text"
                                class="form-control @error('address')
                                is-invaild
                            @enderror"
                                name="address"  autocomplete="address">{{old('address')}}</textarea>
                            @error('address')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">أضف</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
