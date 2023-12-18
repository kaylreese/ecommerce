@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-8">
                <h1>Colors</h1>
            </div>
            <div class="col-sm-4" style="text-align: right;">
                <a href="{{ url('admin/color/create') }}" class="btn btn bg-success">New Color</a>
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
                            <h3 class="card-title">Color List</h3>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Color<th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th style="width: 150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getColors as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->code }}</td>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar" style="width: 100%; background: {{$value->code}}; border: 1px solid #000;"></div>
                                                </div>
                                            </td>
                                            <td>{{ $value->created_by_name }}</td>
                                            <td>{{ ($value->status == 1) ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->created_by_name)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/color/edit/'.$value->id ) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                                <a href="{{ url('admin/color/delete/'.$value->id ) }}" class="btn btn-outline-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="padding: 10px; float: right;">
                                {!! $getColors->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
