@extends('Dashboard.Main')
@section('contant')
    <div class="right_col" role="main">
        <!-- top tiles -->
        <nav>
            <a href="{{ url('dashboard') }}"><h6><i style="font-size: 18px" class="fa fa-home"></i> Dashboard</h6></a>
        </nav>
        <hr>
        <div class="row">
            <div class="col-sm-10 m-auto">
                <div class="x_panel">
                    <div class="text-center">
                        <h2>Edit SubCategorys</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <br>
                        <form action="{{ url('subcategory-update') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $subcategory->id }}" name="subcategory_id">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="category_id">Category Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="">Category Name</option>
                                        @foreach ($categorys as $value)
                                            <option @if ($subcategory->category_id == $value->id)selected
                                            @endif value="{{ $value->id }}">{{ $value->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="subcategory_name">SubCategory Name</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="form-control @error('subcategory_name') is-invalid @enderror" type="text" id="subcategory_name" name="subcategory_name" value="{{ $subcategory->subcategory_name ?? old('subcategory_name') }}">
                                    @error('subcategory_name')
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