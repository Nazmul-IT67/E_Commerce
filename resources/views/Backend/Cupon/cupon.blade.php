@extends('Dashboard.Main')
{{-- @section('cupon')
    active
@endsection --}}
@section('contant')
    <div class="right_col" role="main">
        <!-- top tiles -->
        <nav class="text-capitalize">
            <a href="{{ url('dashboard') }}">Dashboard /</a>
            <span>{{ $last }}</span>
        </nav>
        <hr>
        <div class="row">
            <div class="col-sm-12 m-auto">
                <div class="x_panel">
                    <div class="text-center">
                        <h3>Cupons</h3>
                        <div class="clearfix"></div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Add Cupon</h5>
                                    <form action="{{ route('CuponPost') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Cupon Name:</label>
                                            <div class="mb-3">
                                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name"
                                                value="{{ old('name') }}">

                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="code">Cupon Code:</label>
                                            <div class="mb-3">
                                                <input class="form-control @error('code') is-invalid @enderror" type="text" id="code" name="code"
                                                value="{{ Str::random(10) }}">

                                                @error('code')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="start_date">Cupon Start:</label>
                                            <div class="mb-3">
                                                <input class="form-control @error('start_date') is-invalid @enderror" type="date" id="start_date" name="start_date"
                                                value="{{ old('start_date') }}">

                                                @error('start_date')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="end_date">Cupon End:</label>
                                            <div class="mb-3">
                                                <input class="form-control @error('end_date') is-invalid @enderror" type="date" id="end_date" name="end_date"
                                                value="{{ old('end_date') }}">

                                                @error('end_date')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="discount_type">Discount Type:</label>
                                            <div class="mb-3">
                                                <select name="discount_type" id="discount_type" class="form-control @error('discount_type') is-invalid @enderror">
                                                    <option value>Select Discount Type</option>
                                                    <option value="1">Percent</option>
                                                    <option value="2">Amount</option>
                                                </select>

                                                @error('discount_type')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="discount_amount">Discount Amount:</label>
                                            <div class="mb-3">
                                                <input class="form-control @error('discount_amount') is-invalid @enderror" type="number" id="discount_amount" name="discount_amount"
                                                value="{{ old('discount_amount') }}">

                                                @error('discount_amount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="min_amount">Min Amount:</label>
                                            <div class="mb-3">
                                                <input class="form-control @error('min_amount') is-invalid @enderror" type="number" id="min_amount" name="min_amount"
                                                value="{{ old('min_amount') }}">

                                                @error('min_amount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Cupon List</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Name</th>
                                                    <th>Code</th>
                                                    <th>Start Offer</th>
                                                    <th>End Offer</th>
                                                    <th>Type</th>
                                                    <th>Discount</th>
                                                    <th>Min Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cupons as $key=> $cupon)
                                                    <tr>
                                                        <th>1</th>
                                                        <td>{{ $cupon->name }}</td>
                                                        <td>{{ $cupon->code }}</td>
                                                        <td>{{ $cupon->start_date }}</td>
                                                        <td>{{ $cupon->end_date }}</td>
                                                        <td>{{ $cupon->discount_type==1 ? 'Percentage' : 'Fixed Amount' }}</td>
                                                        <td>{{ $cupon->discount_amount }}{{ $cupon->discount_type==1 ? '%' : 'TK' }}</td>
                                                        <td>{{ $cupon->min_amount }}</td>
                                                        <td>
                                                            <a href="" class="btn btn-sm btn-secondary">Edit</a>
                                                            <a href="" class="btn btn-sm btn-danger">Delete</a>
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
    </div>
@endsection
