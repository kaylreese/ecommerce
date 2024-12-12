@extends('admin.layout.app')

@section('style')

@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-8">
                <h1>Notifications</h1>
            </div>
            <div class="col-sm-4" style="text-align: right;">
                <a href="{{ url('admin/notifications/create') }}" class="btn btn bg-success">New Notification</a>
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
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Notifications</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $value)
                                        <tr>
                                            <td><a style="color: #000; {{ empty($value->is_read) ? 'font-weight: bold;' : '' }}" href="{{ url($value->url) }}?noti_id={{ $value->id }}" target="_blank">{{ $value->message }} </a>
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
    </section>
</div>

@endsection

@section('script')

@endsection
