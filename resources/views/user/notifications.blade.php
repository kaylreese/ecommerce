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
                            <table class="table table-striped">
                                <tbody>
                                    @foreach ($notifications as $value)
                                        <tr>
                                            <td style="padding: 15px;">
                                                <a style="color: #000; {{ empty($value->is_read) ? 'font-weight: bold;' : '' }}" href="{{ url($value->url) }}" target="_blank">{{ $value->message }} </a>
                                                <div>
                                                    <span>{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="padding: 10px; float: right;">
                                {!! $notifications->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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