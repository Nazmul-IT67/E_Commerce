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
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="text-center">
                        <h2>All Products({{ $p_count }})</h2>
                        <div class="clearfix"></div>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="text-right">
                        <a href="{{ url('product-add') }}"><i class="fa fa-plus">Add</i></a>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <div id="datatable_wrapper" class="dataTables_wrapper    container-fluid dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-striped table-bordered dataTable no-footer">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>SL</th>
                                                            <th style="width: 150px">Product Title</th>
                                                            <th>Slyg</th>
                                                            <th>Category</th>
                                                            <th>Summery</th>
                                                            <th>Price</th>
                                                            <th>Thumbnail</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="text-center">
                                                        @foreach ($product as $key=> $user)
                                                            <tr>
                                                                <td>{{ $product->firstItem() +$key}}</td>
                                                                <td>{{ $user->title }}</td>
                                                                <td>{{ $user->slug }}</td>
                                                                <td>{{ $user->category->category_name }}</td>
                                                                <td>{{ Str::limit($user->summery, 20,) }}</td>
                                                                <td>{{ $user->price }}</td>
                                                                <td> <img src="images/{{ $user->thumbnail }}" alt="" width="70"></td>
                                                                <td>
                                                                    <a href=""><button class="btn btn-success">Active</button></a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('ProductEdit',$user->id) }}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                                                                    <a href="{{ route('ProductDelete',$user->id) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width: 25%">
                    {{ $product }}
                </div>
            </div>
        </div>
    </div>
@endsection
