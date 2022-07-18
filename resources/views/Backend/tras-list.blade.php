@extends('Dashboard.Main')
@section('contant')
    <div class="right_col" role="main">
        <!-- top tiles -->
        <nav>
            <a href="{{ url('dashboard') }}">
                <h6><i style="font-size: 18px" class="fa fa-home"></i> Dashboard</h6>
            </a>
        </nav>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="text-center">
                        <h2>Trash ({{ $t_count }})</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                @if (session('success'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <div class="card-box table-responsive">
                                    <div id="datatable_wrapper" class="dataTables_wrapper    container-fluid dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-striped table-bordered dataTable no-footer">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Category Name</th>
                                                            <th>Created_AT</th>
                                                            <th>Updated_AT</th>
                                                            <th>Deleted_AT</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="text-center">
                                                        @foreach ($trash as $key=> $user)
                                                            <tr>
                                                                <td>{{ $trash->firstItem() +$key}}</td>
                                                                <td>{{ $user->category_name }}</td>
                                                                <td>{{ $user->created_at !=null ? $user->created_at->diffForHumans():'N/A' }}</td>
                                                                <td>{{ $user->updated_at !=null ? $user->updated_at->diffForHumans():'N/A' }}</td>
                                                                <td>{{ $user->updated_at !=null ? $user->deleted_at->diffForHumans():'N/A' }}</td>
                                                                <td>
                                                                    <a href=""><button class="btn btn-success">Active</button></a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ url('category-reset') }}/{{ $user->id }}"><button class="btn btn-primary"><i class="fa fa-recycle"></i></button></a>
                                                                    <a href="{{ url('category-sofd') }}/{{ $user->id }}"><button class="btn btn-danger"><i class="fa fa-trash-o"></i></button></a>
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
                    {{ $trash }}
                </div>
            </div>
        </div>
    </div>
@endsection
