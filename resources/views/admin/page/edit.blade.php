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
                    <h1>Edit Page</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        <div class="card card-primary">
            <form action="{{ url('admin/page/edit',$page->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                {{-- @dump($page) --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Name: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $page->name) }}" placeholder="Enter Name" required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Url: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="url" value="{{ old('url', $page->url) }}" placeholder="Enter Url" required>
                                <div style="color: red"> {{ $errors->first('url') }} </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Satus: <span style="color: red">(*)</span></label>
                                <select name="status" class="form-control" required>
                                    <option {{ ($page->state) == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ ($page->state) == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Title: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="title" value="{{ old('title', $page->title) }}" placeholder="Enter Title" required>
                                <div style="color: red"> {{ $errors->first('title') }} </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Image: <span style="color: red">(*)</span></label>
                                <input type="file" class="form-control" name="image_name" value="{{ old('image_name') }}">
                                <div style="color: red"> {{ $errors->first('image_name') }} </div>
                                
                                @if (!empty($page->getImage()))
                                    <img style="width: 200px" src="{{ $page->getImage() }}">
                                @endif
                            </div>
                        </div>
 
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control editor" name="description" id="description" rows="3" placeholder="Enter Description"> {{ old('description', $page->description) }} </textarea>
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Title: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}"  placeholder="Enter Category Name" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Description:</label>
                                <textarea class="form-control editor2" name="meta_description" id="meta_description" rows="3" placeholder="Enter Category Description"> {{ old('meta_description', $page->meta_description) }} </textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Meta Keywords:</label>
                                <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}"  placeholder="Enter Category Keywords">
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="card-footer">
                    <center>
                        <button type="submit" class="btn btn-success">Save</button> 
                        <a type="button" href="{{ url('admin/page') }}"  class="btn btn-danger">Cancel</a>
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

        $('.editor2').summernote({
            height: 100,
        });
    </script>
@endsection