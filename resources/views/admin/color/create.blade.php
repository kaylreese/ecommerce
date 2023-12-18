@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Add New Color</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        <div class="card card-primary">
            <form action="{{ url('admin/color/store') }}" method="POST">
                @csrf 

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Color Name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Code: <span style="color: red">(*)</span></label>
                                <input type="color" class="form-control" name="code" value="{{ old('code') }}" placeholder="Enter Color Url" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Satus: <span style="color: red">(*)</span></label>
                                <select name="status" class="form-control" required>
                                    <option  value="">Select . . .</option>
                                    <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="card-footer">
                    <center>
                        <button type="submit" class="btn btn-success">Save</button> 
                        <a type="button" href="{{ url('admin/color') }}"  class="btn btn-danger">Cancel</a>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
