@extends('frontend.master')
@section('blogs')
active
@endsection

@section('title')
    {{ $blog->title }}
@endsection

@section('ogurl') {{ route('blog.show', $blog->id) }} @endsection
@section('ogtitle') {{ $blog->title }} @endsection
@section('ogdes') {{ $blog->summary }} @endsection
@section('ogimg') {{asset('images/thumbnail/'.$blog->created_at->format('Y/m/').$blog->id.'/'.$blog->thumbnail)}} @endsection

@section('content')

    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Blog Details</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Blog Details</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- blog-details-area start-->
    <div class="blog-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="blog-details-wrap">
                        <img src="{{asset('images/thumbnail/'.$blog->created_at->format('Y/m/').$blog->id.'/'.$blog->thumbnail)}}" alt="{{ $blog->title }}">
                        <h3>{{ $blog->title }}</h3>
                        <ul class="meta">
                            <li>{{ $blog->created_at->format('d M Y') }}</li>
                            <li>By {{ $blog->user->name }}</li>
                        </ul>
                        <p>{{ $blog->summary }}</p>
                       

                        <div class="share-wrap">
                            <div class="row">
                                <div class="col-sm-7 ">
                                    <ul class="socil-icon d-flex">
                                        <li>share it on :</li>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog.show', $blog->id) }}"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <a href="javascript:void(0);">Next Post <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-form-area">
                        <div class="comment-main">
                            <h3 class="blog-title"><span> ({{ $comments->count() }}) </span>Comments:</h3>
                            <ol class="comments">
                                <li class="comment even thread-even depth-1">
                                    @foreach ($comments as $item)

                                    <div class="comment-wrap">
                                        <div class="comment-theme">
                                            <div class="comment-image">
                                                <img src="assets/images/comment/1.png" alt="Jhon">
                                            </div>
                                        </div>
                                        <div class="comment-main-area">
                                            <div class="comment-wrapper">
                                                <div class="sewl-comments-meta">
                                                    <h4>{{ $item->name }} </h4>
                                                    <span>{{ $item->created_at->format('d/M/Y - H:i') }}</span>
                                                </div>
                                                <div class="comment-area">
                                                    <p>{{ $item->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    @endforeach
                                    
                                </li>
                            </ol>
                        </div>
                        <div id="respond" class="sewl-comment-form comment-respond form-style">
                            <h3 id="reply-title" class="blog-title">Leave a <span>comment</span></h3>
                            <form method="post" id="commentform" class="comment-form" action="{{ route('Comments') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="sewl-form-inputs no-padding-left">
                                            <div class="row">
                                                <div class="col-sm-6 col-12">
                                                    <input id="name" name="name" tabindex="2" placeholder="Name" type="text">
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <input id="email" name="email" tabindex="3" placeholder="Email" type="email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="sewl-form-textarea no-padding-right">
                                            <textarea id="comment" name="comment" tabindex="4" rows="3" cols="30" placeholder="Write Your Comments..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-submit">
                                            <input id="submit" value="Send" type="submit">
                                            <input name="blog_id" value="{{ $blog->id }}" id="comment_post_ID" type="hidden">
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <aside class="sidebar-area">
                        <div class="widget widget_categories">
                            <h4 class="widget-title">Categories</h4>
                            <ul>
                                @foreach ($category as $item)

                                    <li><a href="#">{{ $item->category_name }} ({{ $item->blog->count() }})</a></li>

                                @endforeach

                                
                                
                            </ul>
                        </div>
                        <div class="widget widget_recent_entries recent_post">
                            <h4 class="widget-title">Recent Post</h4>
                            <ul>

                                @foreach ($related as $rel)

                                <li>
                                    <div class="post-img">
                                        <img style="width: 70px; height: 60px" src="{{asset('images/thumbnail/'.$rel->created_at->format('Y/m/').$rel->id.'/'.$rel->thumbnail)}}" alt="{{ $rel->title }}" alt="">
                                    </div>
                                    <div class="post-content">
                                        <a href="{{ route('SingleBlog', $rel->id) }}">{{ $rel->title }} </a>
                                        <p>19 JAN 2019</p>
                                    </div>
                                </li>
                                    
                                @endforeach
                               

                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- blog-details-area end -->
    
@endsection