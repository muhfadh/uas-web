@extends('layouts.frontend.app')

@section('title', 'FSLDK MALANG RAYA')

@push('css')

    <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="slider display-table center-text">
    <h1 class="title display-table-cell">
        <b>Forum Silaturahmi Lembaga Dakwah Kampus</b>
        <br>
        Malang Raya
    </h1>
</div>

{{-- <div class="main-slider">
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
        data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
        data-swiper-breakpoints="true" data-swiper-loop="true" >
        <div class="swiper-wrapper">

            @foreach ($categories as $category)
                <div class="swiper-slide">
                    <a class="slider-category" href="#">
                        <div class="blog-image"><img src="{{ Storage::disk('public')->url('category/slider/'.$category->image) }}" alt="{{ $category->name}}"></div>

                        <div class="category">
                            <div class="display-table center-text">
                                <div class="display-table-cell">
                                    <h3><b>{{ $category->name}}</b></h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><!-- swiper-slide -->
            @endforeach

        </div><!-- swiper-wrapper -->

    </div><!-- swiper-container -->

</div><!-- slider --> --}}

<section class="blog-area section">
    <div class="container">
        <div class="row">
            {{-- @foreach($categories as $category) --}}
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">

                    <div class="single-post post-style-2 post-style-3">

                        <div class="blog-info">

                            <h6 class="pre-title"><a href="#"><b></b></a></h6>
                            <h4 class="title"><a href="#"><b>{{ $post->title }}</b></a></h4>

                            <p>{!! $post->body !!}</p>

                            <div class="avatar-area">
                                <a class="avatar" href="#"><img src="{{ $post->user->image }}" alt="Profile Image"></a>
                                <div class="right-area">
                                    <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                                    <h6 class="date" href="#">{{ $post->created_at->toFormattedDateString() }}</h6>
                                </div>
                            </div>

                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
                            </ul>

                        </div><!-- blog-right -->

                    </div><!-- single-post extra-blog -->

                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
            @endforeach
            {{-- @endforeach --}}
        </div>
        {{-- <div class="row">
            @foreach($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="{{ $post->title}}"></div>

                            <a class="avatar" href="#"><img src="images/icons8-team-355979.jpg" alt="Profile Image"></a>

                            <div class="blog-info">

                                <h4 class="title"><a href="#"><b>{{ $post->title }}</b></a></h4>

                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
            @endforeach

        </div><!-- row --> --}}

        <a class="load-more-btn" href="#"><b>LOAD MORE</b></a>

    </div><!-- container -->
</section><!-- section -->
@endsection

@push('js')
@endpush
