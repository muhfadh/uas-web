@extends('layouts.frontend.app')

@section('title')
{{ $post->title }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/single-post/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/single-post/responsive.css') }}">
    <style>
        .header-bg{
            height: 400px;
            width: 100%;
            background-image: url({{Storage::disk('public')->url('post/'.$post->image)}});
            background-size : cover;
        }
        .favorite_posts{
            color: blue;
        }
    </style>
@endpush

@section('content')
<div class="header-bg">

</div><!-- slider -->

<section class="post-area section">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-12 no-right-padding">

                <div class="main-post">

                    <div class="blog-post-inner">

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                                <h6 class="date">{{ $post->created_at->toFormattedDateString() }}</h6>
                            </div>

                        </div><!-- post-info -->

                        <h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>

                        <div class="para">
                            {!! html_entity_decode($post->body) !!}
                        </div>


                        <ul class="tags">
                            @foreach($post->tags as $tag)
                                <li><a href="#">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- blog-post-inner -->

                    <div class="post-icons-area">
                        <ul class="post-icons">
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
                            <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                        </ul>

                        <ul class="icons">
                            <li>SHARE : </li>
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                        </ul>
                    </div>

                </div><!-- main-post -->
            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 no-left-padding">

                <div class="single-post info-area">

                    <div class="sidebar-area about-area">
                        <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                        <p>{{ $post->user->about }}</p>
                    </div>

                    <div class="tag-area">

                        <h4 class="title"><b>Kategori</b></h4>
                        <ul>
                            @foreach($post->categories as $category)
                                <li><a href="#">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>

                    </div><!-- subscribe-area -->

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- post-area -->


<section class="recomended-area section">
    <div class="container">
        <div class="row">
            @foreach($randomposts as $randompost)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">

                    <div class="single-post post-style-1">

                        <div class="blog-info">
                            <h4 class="title"><a href="{{ route('post.details', $randompost->slug) }}"><b>{{ $randompost->title }}</b></a></h4>

                            <div class="column"></div>

                            <div class="avatar-area">
                                <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$randompost->user->image) }}" alt="Profile Image"></a>
                                <div class="right-area">
                                    <a class="name" href="#"><b>{{ $randompost->user->name }}</b></a>
                                    <div class="column"></div>
                                    <p>{!! Str::limit($randompost->body,150) !!}</p>
                                    <div class="column"></div>
                                    <h6 class="date" href="#">{{ $randompost->created_at->toFormattedDateString() }}</h6>
                                </div>
                            </div>

                            <ul class="post-footer">
                                <li>
                                    @guest
                                    <a href="javascript:void(0);" onclick="toastr.info('Untuk menambah ke favorit harus login dulu!', 'Info',{closeButton: true, progressBar: true,})"><i class="ion-heart"></i>{{ $randompost->favorite_to_users->count() }}</a>
                                    @else
                                    <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $randompost->id }}').submit();" class="{{ !Auth::user()->favorite_posts->where('pivot.post_id', $randompost->id)->count() == 0 ? 'favorite_posts' : '' }}"><i class="ion-heart"></i>{{ $randompost->favorite_to_users->count() }}</a>

                                    <form method="POST" id="favorite-form-{{ $randompost->id }}" action="{{ route('post.favorite', $randompost->id) }}" style="display: none;">
                                    @csrf
                                    </form>
                                    @endguest
                                </li>
                                <li><a href="#"><i class="ion-eye"></i>{{ $randompost->view_count }}</a></li>
                            </ul>

                        </div><!-- blog-right -->

                    </div><!-- single-post extra-blog -->

                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
            @endforeach
        </div><!-- row -->

    </div><!-- container -->
</section>
@endsection

@push('js')

@endpush
