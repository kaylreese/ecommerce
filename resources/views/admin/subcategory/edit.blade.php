@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Category</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        <div class="card card-primary">
            <form action="{{ url('admin/subcategory/edit',$getSubCategory->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Satus: <span style="color: red">(*)</span></label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select. . .</option>
                                    @foreach ($getCategories as $value)
                                        <option {{ ($value->id == $getSubCategory->category_id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Name: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $getSubCategory->name) }}" placeholder="Enter Category Name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Url: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="url" value="{{ old('url', $getSubCategory->url) }}" placeholder="Enter Category Url" required>
                                <div style="color: red"> {{ $errors->first('url') }} </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Satus: <span style="color: red">(*)</span></label>
                                <select name="status" class="form-control" required>
                                    <option {{ ($getSubCategory->status) == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ ($getSubCategory->status) == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $getSubCategory->meta_title) }}"  placeholder="Enter Category Name" required>
                            </div>

                            <div class="form-group">
                                <label>Keywords:</label>
                                <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords', $getSubCategory->meta_keywords) }}"  placeholder="Enter Category Keywords">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" name="meta_description" id="meta_description" rows="5" placeholder="Enter Category Description"> {{ old('meta_description', $getSubCategory->meta_description) }} </textarea>
                            </div>
                        </div>

                    </div>
                </div>
              
                <div class="card-footer">
                    <center>
                        <button type="submit" class="btn btn-success">Save</button> 
                        <a type="button" href="{{ url('admin/subcategory') }}"  class="btn btn-danger">Cancel</a>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
