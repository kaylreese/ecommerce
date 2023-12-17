@extends('admin.layout.app')

@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Add New Admin</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        <div class="card card-primary">
            <form action="" method="POST">
                @csrf 

                <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                    <div style="color: red"> {{ $errors->first('email') }} </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Satus</label>
                    <select name="status" class="form-control">
                        <option {{ (old('status') == 0) ? 'selected' : '' }} value="1">Active</option>
                        <option {{ (old('status') == 1) ? 'selected' : '' }} value="0">Inactive</option>
                    </select>
                </div>
              
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Save</button> 
                    <a type="button" href="{{ url('admin/admin/list') }}"  class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection
