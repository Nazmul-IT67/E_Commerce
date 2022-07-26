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
            <div class="col-md-10 m-auto">
                <div class="x_panel">
                    <div class="text-center">
                        <h2>All Categorys({{ $count }})</h2>
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
                        <a href="{{ url('category-add') }}"><i class="fa fa-plus">Add</i></a>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <div id="datatable_wrapper" class="dataTables_wrapper    container-fluid dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-10 m-auto">
                                                <table class="table table-striped table-bordered dataTable no-footer">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Category Name</th>
                                                            <th>Created_AT</th>
                                                            <th>Updated_AT</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="text-center">
                                                        @foreach ($category as $key=> $user)
                                                            <tr>
                                                                <td>{{ $category->firstItem() +$key}}</td>
                                                                <td>{{ $user->category_name }}</td>
                                                                <td>{{ $user->created_at !=null ? $user->created_at->diffForHumans():'N/A' }}</td>
                                                                <td>{{ $user->updated_at !=null ? $user->updated_at->diffForHumans():'N/A' }}</td>
                                                                <td>
                                                                    <a href=""><button class="btn btn-success">Active</button></a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ url('category-edit') }}/{{ $user->id }}"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                                                                    <a href="{{ url('category-delete') }}/{{ $user->id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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
                    {{ $category }}
                </div>
            </div>
        </div>
    </div>
@endsection
