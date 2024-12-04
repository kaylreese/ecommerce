@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Color</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        <div class="card card-primary">
            <form action="{{ url('admin/shippingcharge/edit',$getShippingCharge->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Shipping ChargeName: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $getShippingCharge->name) }}" placeholder="Enter Shipping Charge Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Shipping Charge: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="price" value="{{ old('price', $getShippingCharge->price) }}" placeholder="Enter Shipping Charge" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Satus: <span style="color: red">(*)</span></label>
                                <select name="status" class="form-control" required>
                                    <option  value="">Select . . .</option>
                                    <option {{ (old('status', $getShippingCharge->status) == 1) ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ (old('status', $getShippingCharge->status) == 0) ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <center>
                        <button type="submit" class="btn btn-success">Save</button> 
                        <a type="button" href="{{ url('admin/shippingcharge') }}"  class="btn btn-danger">Cancel</a>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
