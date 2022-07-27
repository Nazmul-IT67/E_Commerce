@extends('Dashboard.Main')
@section('contant')
    <div class="right_col" role="main">
        <!-- top tiles -->
        <nav class="text-capitalize">
            <a href="{{ url('dashboard') }}">Dashboard /</a>
            <span>{{ $last }}</span>
        </nav>
        <hr>
        <div class="row">
            <div class="col-sm-10 m-auto">
                <div class="x_panel">
                    <div class="text-center">
                        <h2>Add Product</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <br>
                        <form action="{{ route('ProductPost') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="category_id">Category Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                        <option value="">Category Name</option>
                                        @foreach ($categorys as $value)
                                            <option value="{{ $value->id }}">{{ $value->category_name }}</option>
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
                                    </select>
                                    @error('subcategory_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Product Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="slug">Product Permalink</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="form-control @error('slug') is-invalid @enderror" type="text" id="slug" name="slug" value="{{ old('slug') }}">
                                    @error('slug')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="price">Product Price</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="form-control @error('price') is-invalid @enderror" type="text" id="price" name="price" value="{{ old('price') }}">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="summery">Product Summery</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea class="form-control @error('summery') is-invalid @enderror" type="text" id="summery" name="summery"></textarea>
                                    @error('summery')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Product Description</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea class="form-control @error('description') is-invalid @enderror" type="text" id="description" name="description"></textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="thumbnail">Product Thumbnail</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="@error('thumbnail') is-invalid @enderror" type="file" id="thumbnail" name="thumbnail">
                                    @error('thumbnail')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
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
