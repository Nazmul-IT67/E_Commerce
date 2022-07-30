@extends('Dashboard.Main')
@section('contant')
    <div class="right_col" role="main">
        <!-- top tiles -->
        <nav class="text-capitalize">
            <a href="{{ url('dashboard') }}">Dashboard /</a>
        </nav>
        <hr>
        <div class="row">
            <div class="col-sm-10 m-auto">
                <div class="x_panel">
                    <div class="text-center">
                        <h2>Edit Product</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <br>
                        <form action="{{ route('ProductUpdate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="brand_name">Brand Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control @error('brand_name') is-invalid @enderror" name="brand_id" id="brand_name">
                                        <option value="">Brand Name</option>
                                        @foreach ($brands as $value)
                                            <option
                                            @if ($product->brand_id==$value->id)
                                                selected
                                            @endif
                                            value="{{ $value->id }}">{{ $value->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="category_id">Category Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                        <option value="">Category Name</option>
                                        @foreach ($categorys as $value)
                                            <option
                                            @if ($product->category_id==$value->id)
                                                selected
                                            @endif
                                            value="{{ $value->id }}">{{ $value->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="subcategory_id">SubCategory Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id" id="subcategory_id">

                                        @foreach ($subcategorys as $value)
                                        <option
                                        @if ($product->subcategory_id==$value->id)
                                            selected
                                        @endif
                                        value="{{ $value->id }}">{{ $value->subcategory_name }}</option>
                                        @endforeach

                                    </select>

                                    @error('subcategory_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Product Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{$product->title ?? old('title') }}">
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="price">Product Price</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="form-control @error('price') is-invalid @enderror" type="text" id="price" name="price" value="{{$product->price ?? old('price') }}">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="thumbnail">Product Thumbnail</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="@error('thumbnail') is-invalid @enderror" type="file" id="thumbnail" name="thumbnail"  value="{{$product->thumbnail ?? old('thumbnail') }}" onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])">
                                    @error('thumbnail')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="thumbnail">Preview Thumbnail</label>
                                <img id="image_id" class="img-fluid w-25" src="{{asset('Images/'.$product->created_at->format('Y/m/').$product->id.'/'.$product->thumbnail)}}" alt="" style="border-radius: 10px">
                            </div>

                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_js')
    <script>
        $('#title').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });

        $('#category_id').change(function(){
            let category_id=$(this).val();
            if(category_id){
                $.ajax({
                    type: 'GET',
                    url: "{{ url('sub-cat') }}/"+category_id,
                    success: function(e){
                        if(e){
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append('<option value>Select Once</option>');
                            $.each(e, function(key, value){
                                $('#subcategory_id').append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                            })
                        }else{
                            $('#subcategory_id').empty();
                        }
                    }
                })
            }else{
                $('#subcategory_id').empty();
            }
        });
    </script>
@endsection
