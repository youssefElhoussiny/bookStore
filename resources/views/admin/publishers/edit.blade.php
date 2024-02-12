@extends('theme.default')
@section('heading')
تعديل الناشر
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="card mb-4 col-md-8">
            <div class="card-header text-center">
                عدل الناشر
            </div>
            <div class="card-body">
                <form action="{{ route('publishers.update',$publisher) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">اسم الناشر</label>
                        <div class="col-md-6">
                            <input id="name" type="text"
                                class="form-control @error('name')
                                is-invaild
                            @enderror"
                                name="name" value="{{ $publisher->name }}" autocomplete="name" />
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
                                name="address" autocomplete="address">{{$publisher->address}}</textarea>
                            @error('address')
                                <span class="invaild-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

