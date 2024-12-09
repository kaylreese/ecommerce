@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-8">
                <h1>Sliders</h1>
            </div>
            <div class="col-sm-4" style="text-align: right;">
                <a href="{{ url('admin/slider/create') }}" class="btn btn bg-success">New Slider</a>
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
                                        <th>Title</th>
                                        <th>Sub Title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th style="width: 150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sliders as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->subtitle }}</td>
                                            <td>
                                                @if (!empty($value->getImage()))
                                                    <img style="width: 200px" src="{{ $value->getImage() }}">
                                                @endif
                                            </td>
                                            <td>{{ ($value->state == 1) ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/slider/edit/'.$value->id ) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                                <a href="{{ url('admin/slider/delete/'.$value->id ) }}" class="btn btn-outline-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No sliders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div style="padding: 10px; float: right;">
                                {!! $sliders->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
