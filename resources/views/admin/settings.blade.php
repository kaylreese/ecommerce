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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Website: </label>
                                            <input type="text" class="form-control" name="website_name" value="{{ old('website_name', $setting->website_name) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Logo: </label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="logo" name="logo" value="{{ old('logo') }}"">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose Logo file</label>
                                                </div>
                                            </div>
                                        </div>
                                        @if (!empty($setting->getLogo()))
                                            <img src="{{ $setting->getLogo() }}" style="width: 200px;">
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Favicon: </label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="favicon" name="favicon" value="{{ old('favicon') }}">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose Favicon file</label>
                                                </div>
                                            </div>
                                        </div>
                                        @if (!empty($setting->getFavicon()))
                                            <img src="{{ $setting->getFavicon() }}" style="width: 50px;">
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Footer Payment Icon: </label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="footer_payment_icon" name="footer_payment_icon" value="{{ old('footer_payment_icon') }}">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose Footer Payment file</label>
                                                </div>
                                            </div>
                                        </div>
                                        @if (!empty($setting->getfooterLogo()))
                                            <img src="{{ $setting->getfooterLogo() }}" style="width: 200px;">
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Footer Description:</label>
                                            <textarea class="form-control" name="footer_description" rows="3" placeholder="Enter Footer Description"> {{ old('footer_description', $setting->footer_description) }} </textarea>
                                        </div>
                                    </div>
                                    <br>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address:</label>
                                            <textarea class="form-control" name="address" rows="3" placeholder="Enter Address"> {{ old('addres', $setting->address) }} </textarea>
                                        </div>
                                    </div>
            
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Phone: </label>
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $setting->phone) }}" placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Phone 2: </label>
                                            <input type="text" class="form-control" name="phone2" value="{{ old('phone2', $setting->phone2) }}" placeholder="Enter Phone 2 Number">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Submit Contact Email: </label>
                                            <input type="text" class="form-control" name="email" value="{{ old('email', $setting->email) }}" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email 2: </label>
                                            <input type="text" class="form-control" name="email2" value="{{ old('email2', $setting->email2) }}" placeholder="Enter Email 2">
                                        </div>
                                    </div>
            
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Working Hour:</label>
                                            <textarea class="form-control" name="working_hours" id="working_hours" rows="5" placeholder="Enter Working Hour">{{ old('working_hours', $setting->working_hours) }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Facebook Link: </label>
                                            <input type="text" class="form-control" name="facebook_link" value="{{ old('facebook_link', $setting->facebook_link) }}" placeholder="Enter Facebook url.">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Twitter Link: </label>
                                            <input type="text" class="form-control" name="twitter_link" value="{{ old('twitter_link', $setting->twitter_link) }}" placeholder="Enter Twitter url.">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Instagram Link: </label>
                                            <input type="text" class="form-control" name="instagram_link" value="{{ old('instagram_link', $setting->instagram_link) }}" placeholder="Enter Instagram url.">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Youtube Link: </label>
                                            <input type="text" class="form-control" name="youtube_link" value="{{ old('youtube_link', $setting->youtube_link) }}" placeholder="Enter Youtube url.">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pinterest Link: </label>
                                            <input type="text" class="form-control" name="pinterest_link" value="{{ old('pinterest_link', $setting->pinterest_link) }}" placeholder="Enter Pinterest url.">
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
