<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ !empty($meta_title) ? $meta_title.' | KaylReese' : '' }}</title>

        @if (!empty($meta_description))
            <meta name="description" content="{{ $meta_description }}">
        @endif

        @if (!empty($meta_keywords))
            <meta name="keywords" content="{{ $meta_keywords }}">
        @endif
            
        @php
            $getSettingsApp = App\Models\SettingModel::getSettings();
        @endphp

        <link rel="shortcut icon" href="{{ $getSettingsApp->getFavicon() }}">

        <link rel="stylesheet" href="{{ url('public/page/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('public/page/css/plugins/owl-carousel/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ url('public/page/css/plugins/magnific-popup/magnific-popup.css') }}">

        <!-- Main CSS File -->
        <link rel="stylesheet" href="{{ url('public/page/css/style.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        @yield('style')
    </head>

    <body>
        <div class="page-wrapper">

            @include('layouts._header')

            @yield('content')

            @include('layouts._footer')

        </div>


        <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

        <div class="mobile-menu-overlay"></div>

        @include('layouts._mobile')
    
        <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-close"></i></span>
                        </button>
    
                        <div class="form-box">
                            <div class="form-tab">
                                <ul class="nav nav-pills nav-fill" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tab-content-5">
                                    <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                        <form action="#" id="FormLogin" method="POST">
                                            @csrf

                                            <div class="form-group">
                                                <label for="singin-email">Email address: <span style="color: rgb(174, 5, 5)">*</span></label>
                                                <input type="text" class="form-control" id="singin-email" name="email" required>
                                            </div>
    
                                            <div class="form-group">
                                                <label for="singin-password">Password: <span style="color: rgb(174, 5, 5)">*</span></label>
                                                <input type="password" class="form-control" id="singin-password" name="password" required>
                                            </div>
    
                                            <div class="form-footer">
                                                <button type="submit" class="btn btn-outline-primary-2">
                                                    <span>LOG IN</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>
    
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="is_remember" class="custom-control-input" id="signin-remember">
                                                    <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                                </div>
    
                                                <a href="{{ url('forgot_password') }}" class="forgot-link">Forgot Your Password?</a>
                                            </div>
                                        </form>
                                        {{-- <div class="form-choice">
                                            <p class="text-center">or sign in with</p>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="#" class="btn btn-login btn-g">
                                                        <i class="icon-google"></i>
                                                        Login With Google
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="#" class="btn btn-login btn-f">
                                                        <i class="icon-facebook-f"></i>
                                                        Login With Facebook
                                                    </a>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                        <form action="#" id="FormRegister" method="POST">
                                            @csrf

                                            <div class="form-group">
                                                <label for="name">Name: <span style="color: rgb(174, 5, 5)">*</span></label>
                                                <input type="text" class="form-control" id="register-name" name="name" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="register-email">Email address: <span style="color: rgb(174, 5, 5)">*</span></label>
                                                <input type="email" class="form-control" id="register-email" name="email" required>
                                            </div>
    
                                            <div class="form-group">
                                                <label for="register-password">Password: <span style="color: rgb(174, 5, 5)">*</span></label>
                                                <input type="password" class="form-control" id="register-password" name="password" required>
                                            </div>
    
                                            <div class="form-footer">
                                                <button type="submit" class="btn btn-outline-primary-2">
                                                    <span>SIGN UP</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>
    
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                    <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> <span style="color: rgb(174, 5, 5)">*</span></label>
                                                </div>
                                            </div>
                                        </form>
                                        {{-- <div class="form-choice">
                                            <p class="text-center">or sign in with</p>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="#" class="btn btn-login btn-g">
                                                        <i class="icon-google"></i>
                                                        Login With Google
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="#" class="btn btn-login  btn-f">
                                                        <i class="icon-facebook-f"></i>
                                                        Login With Facebook
                                                    </a>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Plugins JS File -->
        <script src="{{ url('public/page/js/jquery.min.js') }}"></script>
        <script src="{{ url('public/page/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('public/page/js/jquery.hoverIntent.min.js') }}"></script>
        <script src="{{ url('public/page/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ url('public/page/js/superfish.min.js') }}"></script>
        <script src="{{ url('public/page/js/owl.carousel.min.js') }}"></script>
        <script src="{{ url('public/page/js/wNumb.js') }}"></script>
        <script src="{{ url('public/page/js/bootstrap-input-spinner.js') }}"></script>
        <script src="{{ url('public/page/js/jquery.magnific-popup.min.js') }}"></script>
        @yield('script')
        <!-- Main JS File -->
        <script src="{{ url('public/page/js/main.js') }}"></script>

        <script type="text/javascript">
            $('body').delegate('#FormRegister', 'submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ url('auth_register') }}",
                    data: $(this).serialize(),
                    dataType:"json",
                    success: function(data) {
                        alert(data.message);

                        if (data.status == true) {
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function (data) {

                    }
                });
            });
            
            $('body').delegate('#FormLogin', 'submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ url('auth_login') }}",
                    data: $(this).serialize(),
                    dataType:"json",
                    success: function(data) {
                        alert(data.message);

                        // if (data.status == true) {
                        //     $('#register-name').val('');
                        //     $('#register-email').val('');
                        //     $('#register-password').val('');

                        //     location.reload();
                        // }
                        toastr.success('Loggin succesfully.');
                        if (data.status == true) {
                            $('#register-name').val('');
                            $('#register-email').val('');
                            $('#register-password').val('');

                            location.reload();
                        }
                    },
                    error: function (data) {

                    }
                });
            });
        </script>
    </body>
    
</html>
        