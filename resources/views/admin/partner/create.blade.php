@extends('admin.layout.app')

@section('style')

@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Slider</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        <div class="card card-primary">
            <form action="{{ url('admin/partner/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Button Link: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="button_link" value="{{ old('button_link') }}" placeholder="Enter Button Link">
                                <div style="color: red"> {{ $errors->first('button_link') }} </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                <select name="state" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Image: <span style="color: red">(*)</span></label>
                                <input type="file" class="form-control" name="image_name" value="{{ old('image_name') }}">
                                <div style="color: red"> {{ $errors->first('image_name') }} </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="card-footer">
                    <center>
                        <button type="submit" class="btn btn-success">Save</button> 
                        <a type="button" href="{{ url('admin/partner') }}"  class="btn btn-danger">Cancel</a>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection