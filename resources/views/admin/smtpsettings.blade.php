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
                        <form action="" method="POST">
                            @csrf 
            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name: </label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $setting->name) }}" placeholder="Enter Mail Name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mail Mailer: </label>
                                            <input type="text" class="form-control" name="mail_mailer" value="{{ old('mail_mailer', $setting->mail_mailer) }}" placeholder="Enter Mail Mailer">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mail Host: </label>
                                            <input type="text" class="form-control" name="mail_host" value="{{ old('mail_host', $setting->mail_host) }}" placeholder="Enter Mail Host">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mail Port: </label>
                                            <input type="text" class="form-control" name="mail_port" value="{{ old('mail_port', $setting->mail_port) }}" placeholder="Enter Mail Port">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mail Username: </label>
                                            <input type="text" class="form-control" name="mail_username" value="{{ old('mail_username', $setting->mail_username) }}" placeholder="Enter Mail Username">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mail Password: </label>
                                            <input type="text" class="form-control" name="mail_password" value="{{ old('mail_password', $setting->mail_password) }}" placeholder="Enter Mail Password">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mail Encryption: </label>
                                            <input type="text" class="form-control" name="mail_encryption" placeholder="Enter Mail Encryption" value="{{ old('mail_encryption', $setting->mail_encryption) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mail From Address: </label>
                                            <input type="text" class="form-control" name="mail_from_address" value="{{ old('mail_from_address', $setting->mail_from_address) }}" placeholder="Enter Mail From Address">
                                        </div>
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
