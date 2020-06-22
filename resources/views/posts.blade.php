@extends('layouts.frontend.app')

@section('title', 'Posts')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/category/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/category/responsive.css') }}">
    <style>
        .favorite_posts{
            color: blue;
        }
    </style>
@endpush

@section('content')
<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>Semua Postingan</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">

                        <div class="single-post post-style-1">

                            <div class="blog-info">
                                <h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a></h4>

                                <div class="column"></div>

                                <div class="avatar-area">
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="Profile Image"></a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                                        <div class="column"></div>
                                        <p>{!! $post->body !!}</p>
                                        <div class="column"></div>
                                        <h6 class="date" href="#">{{ $post->created_at->toFormattedDateString() }}</h6>
                                    </div>
                                </div>

                                <ul class="post-footer">
                                    <li>
                                        @guest
                                        <a href="javascript:void(0);" onclick="toastr.info('Untuk menambah ke favorit harus login dulu!', 'Info',{closeButton: true, progressBar: true,})"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                        @else
                                        <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();" class="{{ !Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0 ? 'favorite_posts' : '' }}"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>

                                        <form method="POST" id="favorite-form-{{ $post->id }}" action="{{ route('post.favorite', $post->id) }}" style="display: none;">
                                        @csrf
                                        </form>
                                        @endguest
                                    </li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                </ul>

                            </div><!-- blog-right -->

                        </div><!-- single-post extra-blog -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
            @endforeach
        </div><!-- row -->

        {{ $posts->links() }}

    </div><!-- container -->
</section><!-- section -->
@endsection

@push('js')

@endpush
