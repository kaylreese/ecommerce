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
                <a href="{{ url('admin/subcategory/create') }}" class="btn btn bg-success">New Sub Category</a>
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
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Url</th>
                                        <th>Title</th>
                                        <th>Keywords</th>
                                        <th>Description</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th style="width: 150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getSubCategories as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->category_name }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->url }}</td>
                                            <td>{{ $value->meta_title }}</td>
                                            <td>{{ $value->meta_keywords }}</td>
                                            <td>{{ $value->meta_description }}</td>
                                            <td>{{ $value->created_by_name }}</td>
                                            <td>{{ ($value->status == 1) ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->created_by_name)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/subcategory/edit/'.$value->id ) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                                <a href="{{ url('admin/subcategory/delete/'.$value->id ) }}" class="btn btn-outline-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="padding: 10px; float: right;">
                                {!! $getSubCategories->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
