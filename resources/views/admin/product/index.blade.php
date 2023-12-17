@extends('admin.layout.app')

@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-8">
                <h1>Sub Categories</h1>
            </div>
            <div class="col-sm-4" style="text-align: right;">
                <a href="{{ url('admin/product/create') }}" class="btn btn bg-success">New Product</a>
            </div>
            </div>
        </div>
    </section>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">      

                    @include('admin.layout._message')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sub Category List</h3>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Sub Category</th>
                                        <th>Category</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Brand</th>
                                        <th>Old Price</th>
                                        <th>Price</th>
                                        {{-- <th>Description</th> --}}
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th style="width: 150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getProducts as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->url }}</td>
                                            <td>{{ $value->category_name }}</td>
                                            <td>{{ $value->subcategory_name }}</td>
                                            <td>{{ $value->size }}</td>
                                            <td>{{ $value->color }}</td>
                                            <td>{{ $value->brand_id }}</td>
                                            <td>{{ $value->old_price }}</td>
                                            <td>{{ $value->price }}</td>
                                            {{-- <td>{{ $value->short_description }}</td> --}}
                                            <td>{{ $value->created_by_name }}</td>
                                            <td>{{ ($value->status == 1) ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->created_by_name)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/product/edit/'.$value->id ) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                                <a href="{{ url('admin/product/delete/'.$value->id ) }}" class="btn btn-outline-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="padding: 10px; float: right;">
                                {!! $getProducts->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')

@endsection
