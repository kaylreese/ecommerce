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
                {!! $page->description !!}
            </div>

            <div class="mb-5"></div>
        </div>
    </div>
</main>
@endsection