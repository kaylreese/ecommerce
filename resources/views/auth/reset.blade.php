@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('{{ url('public/page/images/backgrounds/login-bg.jpg') }}')">
            <div class="container">
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link">Reset Password</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            @include('layouts._message')

                            <form action="{{ url('reset/'.$user->remember_token) }}" id="FormForgot" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="forgot-password">New Password: <span style="color: rgb(174, 5, 5)">*</span></label>
                                    <input type="password" class="form-control" id="forgot-password" name="password" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="forgot-cpassword">Confirm Password: <span style="color: rgb(174, 5, 5)">*</span></label>
                                    <input type="password" class="form-control" id="forgot-cpassword" name="cpassword" required>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>Reset</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection