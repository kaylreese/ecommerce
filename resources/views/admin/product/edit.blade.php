@extends('admin.layout.app')

@section('style')
    <link rel="stylesheet" href="{{ url('public/assets/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Product</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        <div class="card card-primary">
            <form action="{{ url('admin/product/edit',$product->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="title" value="{{ old('title', $product->title) }}" placeholder="Enter Product Title" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SKU: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="sku" value="{{ old('sku', $product->title) }}" placeholder="Enter Product SKU" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Category: <span style="color: red">(*)</span></label>
                                <select name="category_id" id="ChangeCategory" class="form-control" required>
                                    <option value="">Select. . .</option>
                                    @foreach ($getCategories as $value)
                                        <option {{ ($value->id == $product->category_id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>SubCategory: <span style="color: red">(*)</span></label>
                                <select name="subcategory_id" id="getSubCategory" class="form-control" required>
                                    <option value="">Select. . .</option>
                                    {{-- @foreach ($getSubCategories as $value)
                                        <option {{ ($value->id == $product->subcategory_id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Brand: <span style="color: red">(*)</span></label>
                                <select name="brand_id" class="form-control" required>
                                    <option value="">Select. . .</option>
                                    @foreach ($getBrands as $value)
                                        <option {{ ($value->id == $product->brand_id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Color: <span style="color: red">(*)</span></label>
                                <select name="color_id" class="form-control" required>
                                    <option value="">Select. . .</option>
                                    @foreach ($getColors as $value)
                                        <option {{ ($value->id == $product->color_id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Url: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="url" value="{{ old('url', $product->url) }}" placeholder="Enter Product Url" required>
                                <div style="color: red"> {{ $errors->first('url') }} </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Price: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="price" value="{{ old('price', $product->price) }}"  placeholder="Enter Product Price" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Old Price: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="old_price" value="{{ old('old_price', $product->old_price) }}"  placeholder="Enter Product Old Price" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Satus: <span style="color: red">(*)</span></label>
                                <select name="status" class="form-control" required>
                                    <option {{ ($product->status) == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ ($product->status) == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Color: <span style="color: red">(*)</span></label>
                                @foreach ($getColors as $value)
                                    <div class="col-sm-1">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input custom-control-input-danger" type="checkbox" {{ ($value->id == $product->color_id) ? 'checked' : '' }} value="{{ $value->id }}" name="color_id[]" id="color_id{{$value->id}}">
                                            <label for="color_id{{$value->id}}" class="custom-control-label">{{ $value->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Size: <span style="color: red">(*)</span></label>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>Name</td>
                                            <td>Price ($)</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody id="AppendSize">
                                        <tr>
                                            <th>
                                                <input type="text" class="form-control form-control-sm" name="price" placeholder="Enter Product Name" required>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control form-control-sm" name="price" placeholder="Enter Product Price" required>
                                            </th>
                                            <th style="width: 60px;">
                                                <button type="button" class="btn btn-outline-info btn-sm AddSize"><i class="fa fa-solid fa-plus"></i></button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Short Description:</label>
                                <textarea class="form-control" name="short_description" rows="3" placeholder="Enter Product Short Description">{{ old('short_description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control editor" name="description" rows="5" placeholder="Enter Product Description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Additional Information:</label>
                                <textarea class="form-control editor2" name="additional_information" rows="5" placeholder="Enter Product Description">{{ old('additional_information') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Shipping Retunrs:</label>
                                <textarea class="form-control editor2" name="shipping_returns" rows="5" placeholder="Enter Product Description">{{ old('shipping_returns') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="card-footer">
                    <center>
                        <button type="submit" class="btn btn-success">Save</button> 
                        <a type="button" href="{{ url('admin/product') }}"  class="btn btn-danger">Cancel</a>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
    {{-- <script src="{{ url('public/tinymce/tinymce-jquery.min.js') }}"></script> --}}
    <script src="{{ url('public/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script type="text/javascript">
        var i = 1000;
        $('body').delegate('.AddSize', 'click', function(){
            var html = '<tr id="DeleteSize'+i+'">\n\
                            <th>\n\
                                <input type="text" class="form-control form-control-sm" name="" >\n\
                            </th>\n\
                            <th>\n\
                                <input type="text" class="form-control form-control-sm" name="" >\n\
                            </th>\n\
                            <th>\n\
                                <button type="button" id="'+i+'" class="btn btn-outline-danger btn-sm DeleteSize"><i class="fa fa-regular fa-trash"></i></button>\n\
                            </th>\n\
                        </tr>';
            i++;
            $('#AppendSize').append(html);
        });

        $('body').delegate('.DeleteSize', 'click', function() {
            var id = $(this).attr('id');
            $('#DeleteSize'+id).remove();
        });

        $('body').delegate("#ChangeCategory", "change", function(e) {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ url('admin/getsubcategory/') }}",
                data: {
                    "id" : id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $("#getSubCategory").html(data.html);
                },
                error: function(data) {

                }
            });
        });

        $('.editor').summernote({
            height: 400,
        });

        $('.editor2').summernote({
            height: 200,
        });
    </script>
@endsection