@extends('frontend.master')

@section('blogs')
active
@endsection

@section('content')
    

 <!-- .breadcumb-area start -->
        <div class="breadcumb-area bg-img-4 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcumb-wrap text-center">
                            <h2>Blog</h2>
                            <ul>
                                <li><a href="{{ route('front') }}">Home</a></li>
                                <li><span>Blog</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .breadcumb-area end -->
        <!-- blog-area start -->
        <div class="blog-area">
            <div class="container">
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Latest News</h2>
                        <img src="assets/images/section-title.png" alt="">
                    </div>
                </div>
                <div class="row">

                    @foreach ($blogs as $blog)

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="blog-wrap">
                            <div class="blog-image">
                                <img src="{{asset('images/thumbnail/'.$blog->created_at->format('Y/m/').$blog->id.'/'.$blog->thumbnail)}}" alt="{{ $blog->title }}">
                                <ul>
                                    <li>{{ $blog->created_at->format('d') }}</li>
                                    <li>{{ $blog->created_at->format('M') }}</li>
                                </ul>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-user"></i> {{ $blog->user->name }}</a></li>
                                        <li class="pull-right"><a href="#"><i class="fa fa-clock-o"></i>{{ $blog->created_at->format('d-m-y') }}</a></li>
                                    </ul>
                                </div>
                                <h3><a href="{{ route('SingleBlog', $blog->id) }}">{{ $blog->title }}</a></h3>
                                <p>{!! Str::limit($blog->summary, 180, '.......') !!}</p>
                            </div>
                        </div>
                    </div>
                        
                    @endforeach

                   

                    <div class="col-12">
                        <div class="pagination-wrapper text-center mb-30">
                            {{-- {{ $blogs->links() }} --}}
                            
                            @if ($blogs->lastPage() > 1)
                                
                            {{-- background: #ef4836;
                                color: #fff;
                                border-color: #ef4836; --}}

                                {{-- height: 30px;
                                    width: 30px;
                                    line-height: 30px;
                                    border: 1px solid #ef4836;
                                        border-top-color: rgb(239, 72, 54);
                                        border-right-color: rgb(239, 72, 54);
                                        border-bottom-color: rgb(239, 72, 54);
                                        border-left-color: rgb(239, 72, 54);
                                    color: #ef4836;
                                    display: inline-block; --}}

                            <ul class="page-numbers">
                                <li><a href="{{ $blogs->url(1) }}" class="{{ $blogs->currentPage() == 1 ? 'disabled' : 'disabled' }}"><i class="fa fa-arrow-left"></i></a></li>
                                @for ($i = 1; $i <= $blogs->lastPage(); $i++)

                                <li class="pagin {{ $blogs->currentPage() == $i ? 'current' : '' }}">
                                    <a class="page-numbers" href="{{ $blogs->url($i) }}">{{ $i }}</a>
                                </li>

                                @endfor
                                

                                <li><a class="{{ $blogs->currentPage() == $blogs->lastPage() ? $blogs->lastPage() : 'disabled' }}" href="{{ $blogs->url($blogs->currentPage() +1) }}"><i class="fa fa-arrow-right"></i></a></li>
                            </ul>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog-area end -->



@endsection