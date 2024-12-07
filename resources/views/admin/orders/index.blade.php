@extends('admin.layout.app')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>Orders</h1>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">      

                    @include('admin.layout._message')

                    <form method="get">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>ID:</label>
                                            <input type="text" class="form-control" placeholder="Enter ID" name="id" value="{{ Request::get('id') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Company Name:</label>
                                            <input type="text" class="form-control" placeholder="Enter Company Name"  name="company_name" value="{{ Request::get('company_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>First Name:</label>
                                            <input type="text" class="form-control" placeholder="Enter First Name"  name="first_name" value="{{ Request::get('first_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Last Name:</label>
                                            <input type="text" class="form-control" placeholder="Enter Last Name"  name="last_name" value="{{ Request::get('last_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input type="text" class="form-control" placeholder="Enter Email"  name="email" value="{{ Request::get('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Phone:</label>
                                            <input type="text" class="form-control" placeholder="Enter "  name="phone" value="{{ Request::get('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Country:</label>
                                            <input type="text" class="form-control" placeholder="Enter Country"  name="country" value="{{ Request::get('country') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>City:</label>
                                            <input type="text" class="form-control" placeholder="Enter City"  name="city" value="{{ Request::get('city') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Postcode:</label>
                                            <input type="text" class="form-control" placeholder="Enter Postcode"  name="postcode" value="{{ Request::get('postcode') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>State:</label>
                                            <input type="text" class="form-control" placeholder="Enter State"  name="state" value="{{ Request::get('state') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>From Date:</label>
                                            <input type="date" class="form-control"  name="from_date" style="padding: 6px;" value="{{ Request::get('from_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>From Date:</label>
                                            <input type="date" class="form-control"  name="to_date" style="padding: 6px;" value="{{ Request::get('to_date') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12"> 
                                        <button type="submit" class="btn btn-primary"> Search </button>
                                        <a href="{{ url('admin/orders') }}" class="btn btn bg-warning">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders List (Total: {{ $getOrders->total() }})</h3>
                        </div>

                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Order Number</th>
                                        <th>Name</th>
                                        <th>Company Name</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>PostCode</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Discount Code</th>
                                        <th>Discount Amount ($)</th>
                                        <th>Shipping Amount ($)</th>
                                        <th>Total Amount ($)</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th style="width: 150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getOrders as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->order_number }}</td>
                                            <td>{{ $value->first_name }} {{ $value->last_name}}</b>
                                            <td>{{ $value->company_name }}</td>
                                            <td>{{ $value->country }}</td>
                                            <td>{{ $value->address_one }} <br /> {{ $value->address_two }}</td>
                                            <td>{{ $value->city }}</td>
                                            <td>{{ $value->state }}</td>
                                            <td>{{ $value->postcode }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->discount_code }}</td>
                                            <td>{{ number_format($value->discount_amount, 2) }}</td>
                                            <td>{{ number_format($value->shipping_amount, 2) }}</td>
                                            <td>{{ number_format($value->total_amount, 2) }}</td>
                                            <td style="text-transform: capitalize;">{{ $value->payment_method }}</td>
                                            <td>
                                                <select name="status" id="{{ $value->id }}" class="form-control ChangeStatus" style="width: 130px">
                                                    <option {{ ($value->status == 0) ? 'selected' : '' }} value="0">Pending</option>
                                                    <option {{ ($value->status == 1) ? 'selected' : '' }} value="1">In Progress</option>
                                                    <option {{ ($value->status == 2) ? 'selected' : '' }} value="2">Delivered</option>
                                                    <option {{ ($value->status == 3) ? 'selected' : '' }} value="3">Completed</option>
                                                    <option {{ ($value->status == 4) ? 'selected' : '' }} value="4">Cancelled</option>
                                                </select>
                                            </td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/orders/detail/'.$value->id ) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                                                {{-- <a href="{{ url('admin/orders/delete/'.$value->id ) }}" class="btn btn-outline-danger btn-sm">Delete</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="padding: 10px; float: right;">
                                {!! $getOrders->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $('body').delegate('.ChangeStatus', 'change', function(){
        var status = $(this).val();
        var order_id = $(this).attr('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type: "GET",
            url: "{{ url('admin/orders/orders_status') }}",
            data: {
                status: status,
                order_id: order_id
            },
            dataType:"json",
            success: function(data) {
                if (data.message) {
                    toastr.success(data.message || 'Action completed successfully!');
                } else {
                    toastr.warning(data.message || 'Action completed with warnings!');
                }
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred: ' + (xhr.responseJSON.message || error));
            }
        });
    })
</script>
@endsection
