@extends('layouts.frontend.app')

@section('title', 'Blog')

@push('css')

    <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet">
    <style>
        .favorite_posts{
            color:blue;
        }
    </style>
@endpush

@section('content')
<div class="slider display-table center-text">
    <h1 class="title display-table-cell">
        <b>Blog</b>
        <br>
        UAS WEB 4G
    </h1>
</div>
@endsection

@push('js')
@endpush
