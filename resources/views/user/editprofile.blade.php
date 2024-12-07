@extends('layouts.app')

@section('style')

@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">{{ $header_title }}</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <br>
                <div class="row">
                    @include('user._sidebar')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="col-lg-12">
                                @include('layouts._message')

                                <form action="" id="FormUser" method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" name="first_name" value="{{ !empty(Auth::user()->name) ? $user->name : '' }}" class="form-control" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" name="last_name" value="{{ !empty(Auth::user()->last_name) ? $user->last_name : '' }}" class="form-control" required>
                                        </div>
                                    </div>

                                    <label>Email address *</label>
                                    <input type="email" name="email" value="{{ !empty(Auth::user()->email) ? $user->email : '' }}" class="form-control" required>

                                    <label>Company Name (Optional)</label>
                                    <input type="text" name="company_name" value="{{ !empty(Auth::user()->company_name) ? $user->company_name : '' }}" class="form-control">

                                    <label>Country *</label>
                                    <input type="text" name="country" value="{{ !empty(Auth::user()->country) ? $user->country : '' }}" class="form-control" required>

                                    <label>Street address *</label>
                                    <input type="text" name="address_one" value="{{ !empty(Auth::user()->address_one) ? $user->address_one : '' }}" class="form-control" placeholder="House number and Street name" required>
                                    <input type="text" name="address_two" value="{{ !empty(Auth::user()->address_two) ? $user->address_two : '' }}" class="form-control" placeholder="Appartments, suite, unit etc ..." required>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Town / City *</label>
                                            <input type="text" name="city" value="{{ !empty(Auth::user()->city) ? $user->city : '' }}" class="form-control" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>State / County *</label>
                                            <input type="text" name="state" value="{{ !empty(Auth::user()->state) ? $user->state : '' }}" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Postcode / ZIP *</label>
                                            <input type="text" name="postcode" value="{{ !empty(Auth::user()->postcode) ? $user->postcode : '' }}" class="form-control" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label>Phone *</label>
                                            <input type="tel" name="phone" value="{{ !empty(Auth::user()->phone) ? $user->phone : '' }}" class="form-control" required>
                                        </div>
                                    </div>

                                    <button type="submit" style="width: 100px;" class="btn btn-outline-primary-2 btn-order btn-block">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection