@extends('admin.layout.app')

@section('content')


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>{{ $header_title }}</h1>
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf 
            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Trendy Product Title: </label>
                                            <input type="text" class="form-control" name="trendy_product_title" value="{{ old('trendy_product_title', $setting->trendy_product_title) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Shop Category Title: </label>
                                            <input type="text" class="form-control" name="shop_category_title" value="{{ old('shop_category_title', $setting->shop_category_title) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Recent Arrivals Title: </label>
                                            <input type="text" class="form-control" name="recent_arrivals_title" value="{{ old('recent_arrivals_title', $setting->recent_arrivals_title) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Blog Title: </label>
                                            <input type="text" class="form-control" name="blog_title" value="{{ old('blog_title', $setting->blog_title) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Payment Delivery: </label>
                                            <input type="text" class="form-control" name="payment_delivery" value="{{ old('payment_delivery', $setting->payment_delivery) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Payment Delivery Description: </label>
                                            <textarea class="form-control" name="payment_delivery_description" id="payment_delivery_description" rows="1" placeholder="Enter Payment Delivery Description">{{ old('payment_delivery_description', $setting->payment_delivery_description) }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Delivery Icon: </label>
                                            <textarea class="form-control" name="payment_delivery_image" id="payment_delivery_image" rows="1" placeholder="Enter Payment Delivery Icon">{{ old('payment_delivery_image', $setting->payment_delivery_image) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Refund Title: </label>
                                            <input type="text" class="form-control" name="refund_title" value="{{ old('refund_title', $setting->refund_title) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Refund Description: </label>
                                            <textarea class="form-control" name="refund_description" id="refund_description" rows="1" placeholder="Enter Refund Description">{{ old('refund_description', $setting->refund_description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Refund Icon: </label>
                                            <input type="text" class="form-control" name="refund_image" value="{{ old('refund_image', $setting->refund_image) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Support Title: </label>
                                            <input type="text" class="form-control" name="support_title" value="{{ old('support_title', $setting->support_title) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Support Description: </label>
                                            <textarea class="form-control" name="support_description" id="support_description" rows="1" placeholder="Enter Support Description">{{ old('support_description', $setting->support_description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Support Icon: </label>
                                            <input type="text" class="form-control" name="support_image" value="{{ old('support_image', $setting->support_image) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Singup Title:</label>
                                            <input type="text" class="form-control" name="singup_title" value="{{ old('singup_title', $setting->singup_title) }}">
                                        </div>
                                    </div>
                                    <br>
                                    
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Singup Description:</label>
                                            <textarea class="form-control" name="singup_description" id="singup_description" rows="1" placeholder="Enter Singup Description">{{ old('singup_description', $setting->singup_description) }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="singup_image">Singup Image: </label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="singup_image" name="singup_image" value="{{ old('singup_image') }}">
                                                    <label class="custom-file-label" for="singup_image">Choose Singup Image file</label>
                                                </div>
                                            </div>
                                        </div>
                                        @if (!empty($setting->getSingupImage()))
                                            <img src="{{ $setting->getSingupImage() }}" style="width: 200px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer">
                                <center>
                                    <button type="submit" class="btn btn-primary">Update</button> 
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
