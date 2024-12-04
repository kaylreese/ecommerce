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
            <form action="{{ url('admin/discountcode/edit',$getDiscountCode->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Discount Code Name: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $getDiscountCode->name) }}" placeholder="Enter Discount Code Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type: <span style="color: red">(*)</span></label>
                                <select name="type" class="form-control" required>
                                    <option value="">Select . . .</option>
                                    <option {{ (old('type', $getDiscountCode->type) == 'Amount') ? 'selected' : '' }} value="Amount">Amount</option>
                                    <option {{ (old('type', $getDiscountCode->type) == 'Percent') ? 'selected' : '' }} value="Percent">Percent</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount / Percent: <span style="color: red">(*)</span></label>
                                <input type="text" class="form-control" name="percent_amount" value="{{ old('percent_amount', $getDiscountCode->percent_amount) }}" placeholder="Enter Amount - Percent" required>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Expire Date: <span style="color: red">(*)</span></label>
                                <input type="date" class="form-control" name="expire_date" value="{{ old('expire_date', $getDiscountCode->expire_date) }}" placeholder="Enter Expire Date" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Satus: <span style="color: red">(*)</span></label>
                                <select name="status" class="form-control" required>
                                    <option  value="">Select . . .</option>
                                    <option {{ (old('status', $getDiscountCode->status) == 1) ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ (old('status', $getDiscountCode->status) == 0) ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <center>
                        <button type="submit" class="btn btn-success">Save</button> 
                        <a type="button" href="{{ url('admin/discountcode') }}"  class="btn btn-danger">Cancel</a>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
