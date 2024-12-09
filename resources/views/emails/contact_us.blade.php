@component('mail::message')
Hi <b>{{ $contact->name }}</b>,

<p>We receive your information successfully:</p>

<p><b>Name: </b>{{  $contact->name }}</p>
<p><b>Email: </b>{{  $contact->email }}</p>
<p><b>Phone: </b>{{  $contact->phone }}</p>
<p><b>Subject: </b>{{  $contact->subject }}</p>
<p><b>Message: </b>{{  $contact->message }}</p>

@endcomponent