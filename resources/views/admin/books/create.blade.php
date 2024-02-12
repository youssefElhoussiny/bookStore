@extends('theme.default')
@section('heading')
    اضافة كتاب جديد
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="card mb-4 col-md-8">
            <div class="card-header text-center">
                اضف كتابا جديدا
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">عنوان الكتاب</label>
                        <div class="col-md-6">
                            <input id="title" type="text"
                                class="form-control @error('title')
                                is-invaild
                            @enderror"
                                name="title" value="{{ old('title') }}" autocomplete="title" />
                            @error('title')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="isbn" class="col-md-4 col-form-label text-md-right">الرقم التسلسلي</label>
                        <div class="col-md-6">
                            <input id="isbn" type="text"
                                class="form-control @error('isbn')
                                is-invaild
                            @enderror"
                                name="isbn" value="{{ old('isbn') }}" autocomplete="isbn" />
                            @error('isbn')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cover_image" class="col-md-4 col-form-label text-md-right">صورة الغلاف</label>
                        <div class="col-md-6">
                            <input id="cover_image" accept="image/*" type="file"
                                class="form-control @error('cover_image')
                                is-invaild
                            @enderror"
                                name="cover_image" value="{{ old('cover_image') }}" autocomplete="cover_image" 
                                onchange="readCoverImage(this)"
                                />
                            @error('cover_image')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <img  alt="" id="cover-image-thumb" class="img-fluid img-thumbnail" src="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="col-md-4 col-form-label text-md-right">التصنيف</label>
                        <div class="col-md-6">
                           <select name="category" id="category" class="form-control">
                                <option disabled selected >اختر تصنيفا</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                           </select>
                            @error('category')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="authors" class="col-md-4 col-form-label text-md-right">المؤلفون</label>
                        <div class="col-md-6">
                            <select name="authors[]" multiple id="authors" class="form-control">
                                <option disabled selected >اختر المؤلفين</option>
                                @foreach ($authors as $author)
                                    <option value="{{$author->id}}">{{$author->name}}</option>
                                @endforeach
                           </select>
                            @error('authors')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="publisher" class="col-md-4 col-form-label text-md-right">الناشر</label>
                        <div class="col-md-6">
                            <select name="publisher"  id="publisher" class="form-control">
                                <option disabled selected >اختر الناشر</option>
                                @foreach ($publishers as $publisher)
                                    <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                                @endforeach
                           </select>
                            @error('publisher')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">الوصف</label>
                        <div class="col-md-6">
                            <textarea id="description" type="text"
                                class="form-control @error('description')
                                is-invaild
                            @enderror"
                                name="description" value="{{ old('description') }}" autocomplete="description"></textarea>
                            @error('description')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="publish_year" class="col-md-4 col-form-label text-md-right">سنة النشر</label>
                        <div class="col-md-6">
                            <input id="publish_year" type="number"
                                class="form-control @error('publish_year')
                                is-invaild
                            @enderror"
                                name="publish_year" value="{{ old('publish_year') }}" autocomplete="publish_year" />
                            @error('publish_year')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="number_of_pages" class="col-md-4 col-form-label text-md-right">عدد الصفحات</label>
                        <div class="col-md-6">
                            <input id="number_of_pages" type="number"
                                class="form-control @error('number_of_pages')
                                is-invaild
                            @enderror"
                                name="number_of_pages" value="{{ old('number_of_pages') }}" autocomplete="number_of_pages" />
                            @error('number_of_pages')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="number_of_copies" class="col-md-4 col-form-label text-md-right">عدد النسخ</label>
                        <div class="col-md-6">
                            <input id="number_of_copies" type="number"
                                class="form-control @error('number_of_copies')
                                is-invaild
                            @enderror"
                                name="number_of_copies" value="{{ old('number_of_copies') }}" autocomplete="number_of_copies" />
                            @error('number_of_copies')
                                <span class="invaild-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">السعر</label>
                        <div class="col-md-6">
                            <input id="price" type="number"
                                class="form-control @error('price')
                                is-invaild
                            @enderror"
                                name="price" value="{{ old('price') }}" autocomplete="price" />
                            @error('price')
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
@section('script')
    <script>
         function readCoverImage(input)
         {
            if(input.files && input.files[0])
            {
                var reader = new FileReader();
                reader.onload = function(e)
                {
                    $('#cover-image-thumb')
                    .attr('src',e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
         }
    </script>
@endsection
