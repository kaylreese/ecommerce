@extends('admin.layout.app')

@section('style')
    <link rel="stylesheet" href="{{ url('public/assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/cssadmin.css') }}">
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Add New Sub Category</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        <div class="card card-primary">
            <form action="{{ url('admin/blog/store') }}" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Blog Category: <span style="color: red">(*)</span></label>
                                <select name="blogcategory_id" class="form-control" required>
                                    <option value="">Select. . .</option>
                                    @foreach ($getCategories as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter Blog Title" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Satus: <span style="color: red">(*)</span></label>
                                <select name="status" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Short Description:</label>
                                <textarea class="form-control" name="short_description" id="short_description" rows="5" placeholder="Enter Short Description">{{ old('short_description') }}</textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control editor" name="description" id="description" rows="5" placeholder="Enter Blog Description">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Meta Title: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" placeholder="Enter Category Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Meta Keywords:</label>
                                <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="Enter Category Keywords">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Meta Description:</label>
                                <textarea class="form-control" name="meta_description" id="meta_description" rows="1" placeholder="Enter Meta Description">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
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
                        <a type="button" href="{{ url('admin/category') }}"  class="btn btn-danger">Cancel</a>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script src="{{ url('public/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ url('public/assets/sortable/jquery-ui.js') }}"></script>

    <script type="text/javascript">
        $('.editor').summernote({
            height: 300,
        });
    </script>
@endsection