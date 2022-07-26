@extends('Dashboard.Main')
@section('contant')
    <div class="right_col" role="main">
        <!-- top tiles -->
        <nav class="text-capitalize">
            <a href="{{ url('dashboard') }}">Dashboard</a>
        </nav>
        <hr>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="text-center">
                        <h2>Edit Category</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <br>
                        <form action="{{ url('category-update') }}" method="POST">
                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="category_name">Category Name</label>
                                <input type="hidden" name="category_id" value="{{ $category->id }}">
                                <div class="col-md-6 col-sm-6 ">
                                    <input class="form-control @error('category_name') is-invalid @enderror" type="text" id="category_name" name="category_name" value="{{ $category->category_name ?? old('category_name') }}">
                                    @error('category_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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
