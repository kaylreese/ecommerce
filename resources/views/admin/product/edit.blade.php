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
                    <h1>Edit Product</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        @include('admin.layout._message')

        <div class="card card-primary">
            <form action="{{ url('admin/product/edit',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Title: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="title" value="{{ old('title', $product->title) }}" placeholder="Enter Product Title" required>
                            </div>
                        </div>

                        <div class="col-md-3">
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
                                    @foreach ($getsubcategory as $value)
                                        <option {{ ($value->id == $product->subcategory_id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
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
                                <label>Url: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="url" value="{{ old('url', $product->url) }}" placeholder="Enter Product Url" required>
                                <div style="color: red"> {{ $errors->first('url') }} </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Price: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="price" value="{{ !empty($product->price) ? $product->price : '' }}"  placeholder="Enter Product Price" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Old Price: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="old_price" value="{{ !empty($product->old_price) ? $product->old_price : '' }}"  placeholder="Enter Product Old Price" required>
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
                            <div class="form-group-admin">
                                <label>Color: <span style="color: red">(*)</span></label>
                                @foreach ($getColors as $value)
                                    @php
                                        $checked = '';
                                    @endphp

                                    @foreach ($product->getColor as $val)
                                        @if($val->color_id == $value->id)
                                            @php
                                                $checked = 'checked';
                                            @endphp
                                        @endif
                                    @endforeach

                                    <div class="col-sm-1">
                                        <div class="custom-control custom-checkbox">
                                            <input {{ $checked }} class="custom-control-input custom-control-input-danger" type="checkbox" {{ ($value->id == $product->color_id) ? 'checked' : '' }} value="{{ $value->id }}" name="color_id[]" id="color_id{{$value->id}}">
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
                                        @php
                                            $i_s = 1;
                                        @endphp

                                        @foreach($product->getSize as $value)
                                            <tr id="DeleteSize{{$i_s}}">
                                                <th>
                                                    <input type="text" class="form-control form-control-sm" value="{{ $value->name }}" name="size[{{$i_s}}][name]" placeholder="Enter Product Name" >
                                                </th>
                                                <th>
                                                    <input type="text" class="form-control form-control-sm" value="{{ $value->price }}" name="size[{{$i_s}}][price]" placeholder="Enter Product Price" >
                                                </th>
                                                <th style="width: 60px;">
                                                    <button type="button" id="{{$i_s}}" class="btn btn-outline-danger btn-sm DeleteSize"><i class="fa fa-regular fa-trash"></i></button>
                                                </th>
                                            </tr>
                                            @php
                                                $i_s++;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <th>
                                                <input type="text" class="form-control form-control-sm" name="size[100][name]" placeholder="Enter Product Name">
                                            </th>
                                            <th>
                                                <input type="text" class="form-control form-control-sm" name="size[100][price]" placeholder="Enter Product Price">
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

                    <hr>

                    <div class="row">
                        <div class="col-md-10">
                            {{-- <div class="form-group">
                                <label>Images:</label>
                                <input type="file" class="form-control" style="padding: 5px;" name="image[]" multiple accept="image/*">
                            </div> --}}

                            <div class="form-group">
                                <label for="exampleInputFile">Images:</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image[]" id="name" multiple accept="image/*">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label> </label>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" {{ !empty($product->is_trendy) ? 'checked' : '' }}  name="is_trendy" id="is_trendy">
                                  <label class="custom-control-label" for="is_trendy"> Is Trendy?: <span style="color: red">(*)</span></label>
                                </div>
                              </div>
                        </div>      
                    </div>

                    @if(!empty($product->getImages->count()))
                        <div class="row" id="sortable">
                            @foreach($product->getImages as $value)
                                @if(!empty($value->getLogo()))
                                    <div class="col-md-1 sortable_image" id="{{ $value->id }}" style="text-align: center;">
                                        <img src="{{ $value->getLogo() }}" style="width: 100%;  height: 100px">
                                        <a type="button" href="{{ url('admin/product/image_delete/'.$value->id ) }}"  class="btn btn-outline-danger btn-sm" style="margin: 5px;" onclick="return confirm('Are you sure want to delete?');"><i class="fa fa-regular fa-trash"></i></a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Short Description:</label>
                                <textarea class="form-control" name="short_description" rows="3" placeholder="Enter Product Short Description"> {{ old('short_description', $product->short_description) }} </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control editor" name="description" rows="5" placeholder="Enter Product Description"> {{ old('description', $product->description) }} </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Additional Information:</label>
                                <textarea class="form-control editor2" name="additional_information" rows="5" placeholder="Enter Product Description"> {{ old('additional_information', $product->additional_information) }} </textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Shipping Retunrs:</label>
                                <textarea class="form-control editor2" name="shipping_returns" rows="5" placeholder="Enter Product Description">{{ old('shipping_returns', $product->shipping_returns) }}</textarea>
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
    <script src="{{ url('public/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ url('public/assets/sortable/jquery-ui.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var photo_id = new Array();
                    $('.sortable_image').each(function() {
                        var id = $(this).attr('id');
                        photo_id.push(id);
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ url('admin/product_image_sortable/') }}",
                        data: {
                            "photo_id" : photo_id,
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            
                        },
                        error: function(data) {

                        }
                    });
                }
            });
        });

        // $( "#sortable" ).sortable();

        var i = 101;
        $('body').delegate('.AddSize', 'click', function(){
            var html = '<tr id="DeleteSize'+i+'">\n\
                            <th>\n\
                                <input type="text" class="form-control form-control-sm" name="size['+i+'][name]" >\n\
                            </th>\n\
                            <th>\n\
                                <input type="text" class="form-control form-control-sm" name="size['+i+'][price]" >\n\
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
            height: 300,
        });

        $('.editor2').summernote({
            height: 100,
        });
    </script>
@endsection