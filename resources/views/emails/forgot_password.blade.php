@component('mail::message')

Hello {{ $user->name }},

<p>We understand it happens. </p>

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Reset Your Password
@endcomponent

<p>In case you have any issues recovering your password, please contact us. </p>

@php
    $getSetting = App\Models\SettingModel::getSettings();
@endphp

Thanks,<br>
{{ $getSetting->website_name }}
@endcomponent