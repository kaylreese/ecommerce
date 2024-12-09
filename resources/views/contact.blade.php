@extends('layouts.app')

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
            </ol>
        </div>
    </nav>
    <div class="container">
        <div class="page-header page-header-big text-center" style="background-image: url('{{ $page->getImage() }}')">
            <h1 class="page-title text-white">{{ $page->title }}</h1>
        </div>
    </div>

    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    {!! $page->description !!}
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="contact-info">
                                <ul class="contact-list">
                                    @if (!empty($setting->address))
                                        <li>
                                            <i class="icon-map-marker"></i>
                                            {{ $setting->address }}
                                        </li>
                                    @endif

                                    @if (!empty($setting->phone2))
                                        <li>
                                            <i class="icon-phone"></i>
                                            <a href="tel:#">{{ $setting->phone }} | {{ $setting->phone2 }}</a>
                                        </li>
                                    @endif

                                    @if (!empty($setting->email2))
                                        <li>
                                            <i class="icon-envelope"></i>
                                            <a href="mailto:#">{{ $setting->email2 }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="contact-info">
                                <ul class="contact-list">
                                    @if (!empty($setting->working_hours))
                                        <li>
                                            <i class="icon-clock-o"></i>
                                            <span class="text-dark">{{ $setting->working_hours }}</span> <br>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="title mb-1">Got Any Questions?</h2>
                    <p class="mb-2">Use the form below to get in touch with the sales team</p>

                    <form action="#" class="contact-form mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cname" class="sr-only">Name</label>
                                <input type="text" class="form-control" id="cname" placeholder="Name *" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="cemail" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="cemail" placeholder="Email *" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cphone" class="sr-only">Phone</label>
                                <input type="tel" class="form-control" id="cphone" placeholder="Phone">
                            </div>

                            <div class="col-sm-6">
                                <label for="csubject" class="sr-only">Subject</label>
                                <input type="text" class="form-control" id="csubject" placeholder="Subject">
                            </div>
                        </div>

                        <label for="cmessage" class="sr-only">Message</label>
                        <textarea class="form-control" cols="30" rows="4" id="cmessage" required placeholder="Message *"></textarea>

                        <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>SUBMIT</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
            <br><br>
        </div>
    </div>
</main>
@endsection