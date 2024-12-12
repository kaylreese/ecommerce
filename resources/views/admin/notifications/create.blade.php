@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Add New Category</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        <div class="card card-primary">
            <form action="{{ url('admin/notifications/store') }}" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Name: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Category Name" required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Url: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="url" value="{{ old('url') }}" placeholder="Enter Category Url" required>
                                <div style="color: red"> {{ $errors->first('url') }} </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Satus: <span style="color: red">(*)</span></label>
                                <select name="status" class="form-control" required>
                                    <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" placeholder="Enter Category Name" required>
                            </div>

                            <div class="form-group">
                                <label>Keywords:</label>
                                <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="Enter Category Keywords">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" name="meta_description" id="meta_description" rows="5" placeholder="Enter Category Description">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Button Name: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="button_name" value="{{ old('button_name') }}" placeholder="Enter Button Name">
                                <div style="color: red"> {{ $errors->first('button_name') }} </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label> </label>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" name="is_home" id="is_home">
                                  <label class="custom-control-label" for="is_home"> Is Home?: <span style="color: red">(*)</span></label>
                                </div>
                              </div>
                        </div>       

                        <div class="col-md-2">
                            <div class="form-group">
                                <label> </label>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" name="is_menu" id="is_menu">
                                  <label class="custom-control-label" for="is_menu"> Is Menu?: <span style="color: red">(*)</span></label>
                                </div>
                              </div>
                        </div>                        

                        <div class="col-md-5">
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
                        <a type="button" href="{{ url('admin/notifications') }}"  class="btn btn-danger">Cancel</a>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
