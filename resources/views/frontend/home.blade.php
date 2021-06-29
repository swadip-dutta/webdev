@extends('frontend.master')

@section('home')
active
@endsection

@section('content')

    <!-- slider-area start -->
    <div class="slider-area">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide overlay">
                    <div class="single-slider slide-inner slide-inner1">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">Summer New T-Shirt</h2>
                                            <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                            <a href="{{ route('Shop') }}" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-inner slide-inner7">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">Jackson Brand T-Shirt</h2>
                                            <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                            <a href="{{ route('Shop') }}" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-inner slide-inner8">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">Winter New T-shirt</h2>
                                            <p data-swiper-parallax="-400">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</p>
                                            <a href="{{ route('Shop') }}" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- slider-area end -->
    <!-- featured-area start -->
    <div class="featured-area featured-area2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="featured-active2 owl-carousel next-prev-style">


                        @foreach ($products as $item)

                        <div class="featured-wrap">
                            <div class="featured-img">
                                <img src="{{asset('images/'.$item->thumbnail)}}" style="width: 300px; height: 300px" alt="{{$item->title}}">
                                <div class="featured-content" style="left: 44%">
                                    <a href="{{ route('SingleProduct', $item->id) }}">{{ $item->title }}</a>
                                </div>
                            </div>
                        </div>
                            
                        @endforeach

                        
                        
                        
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured-area end -->
    <!-- start count-down-section -->
    <div class="count-down-area count-down-area-sub">
        <section class="count-down-section section-padding parallax" data-speed="7">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 text-center">
                        <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
                    </div>
                    <div class="col-12 col-lg-12 text-center">
                        <div class="count-down-clock text-center">
                            <div id="clock">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
    </div>
    <!-- end count-down-section -->
    <!-- product-area start -->
    <div style="padding-bottom: 20px;" class="product-area product-area-2">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Best Seller</h2>
                        <img src="assets/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
                @foreach ($bestsell as $item)           
                @if ($item->rating > 3)
                    
               <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="product-wrap">
                        <div class="product-img">
                            <span>Sale</span>
                            <img src="{{asset('images/'.$item->Product->thumbnail)}}" alt="{{$item->title}}">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a href="{{ route('SingleProduct', $item->Product->id) }}"><i class="fa fa-eye"></i></a></li>
                                    
                                    <li><a href="{{ route('WishAdd', [$item->Product->id, $item->Product->category_id, $item->Product->subcategory_id, $item->Product->brand_id]) }}"><i class="fa fa-heart"></i></a></li>
                                       
                                    <li><a href="{{ route('SingleProduct', $item->Product->id) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="product-content">
                            <h3><a href="{{ route('SingleProduct', $item->Product->id) }}">{{$item->Product->title}}</a></h3>
                            <p class="pull-left">$ {{ $item->Product->price }}
                            </p>
                            <ul class="pull-right d-flex">

                                @if (empty($item->rating))
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>

                                @elseif ($item->rating == 1)
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                @elseif ($item->rating == 2)
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                @elseif ($item->rating == 3)
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                @elseif ($item->rating == 4)
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                @elseif ($item->rating == 5)
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>

            @endif    
                         
        @endforeach
                
            </ul>
        </div>
    </div>
    <!-- product-area end -->
    <!-- product-area start -->
    <div class="product-area">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Our Latest Product</h2>
                        <img src="assets/images/section-title.png" alt="title">
                        
                    </div>
                </div>
            </div>
            <ul class="row">

                @foreach ($products as $key => $item)
                
                <li class="col-xl-3 col-lg-4 col-sm-6 col-12 {{ $products->count() }} @if($key + 1 > 0) moreload @endif">
                    <div class="product-wrap">
                        <div class="product-img">
                            <span>Sale</span>
                            <img src="{{asset('images/'.$item->thumbnail)}}" alt="{{$item->title}}">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a href="{{ route('SingleProduct', $item->id) }}"><i class="fa fa-eye"></i></a></li>
                                    
                                    <li><a href="{{ route('WishAdd', [$item->id, $item->category_id, $item->subcategory_id, $item->brand_id]) }}"><i class="fa fa-heart"></i></a></li>
                                       
                                    <li><a href="{{ route('SingleProduct', $item->id) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>


                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{ route('SingleProduct', $item->id) }}">{{$item->title}}</a></h3>
                            <p class="pull-left">$ {{ $item->price }}
                            </p>
                            <ul class="pull-right d-flex">

                                @if (empty($item->ProductRev->rating))
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>

                                @elseif ($item->ProductRev->rating == 1)
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                @elseif ($item->ProductRev->rating == 2)
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                @elseif ($item->ProductRev->rating == 3)
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                @elseif ($item->ProductRev->rating == 4)
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                @elseif ($item->ProductRev->rating == 5)
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </li> 
                
                
    <!-- Modal area start -->
    <form action="{{ route('AddToCart') }}" method="post">
        @csrf
    <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body d-flex">
                    <div class="product-single-img w-50">
                    <img src="{{asset('images/'. $item->thumbnail)}}" alt="{{ $item->title }}">
                    </div>
                    <div class="product-single-content w-50">
                        <h3>{{$item->title}}</h3>
                        <div class="rating-wrap fix">
                            <span class="pull-left">৳ {{$item->price}}</span>
                            <ul class="rating pull-right">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li>(05 Customar Review)</li>
                            </ul>
                        </div>
                        <p>{{$item->description}}</p>
                        <ul class="input-style">
                            <li class="quantity cart-plus-minus">
                                <input type="text" value="1" />
                            </li>
                            <li><a href="cart.html">Add to Cart</a></li>
                        </ul>
                        <ul class="cetagory">
                        <li>Categories: {{ $item->Category->category_name }}</li>
                        </ul>

                        

                        <ul class="socil-icon">
                            <li>Share :</li>
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('SingleProduct', $item->id) }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
           
@endforeach

                <li class="col-12 text-center">
                    <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- product-area end -->
    <!-- testmonial-area start -->
    <div class="testmonial-area testmonial-area2 bg-img-2 black-opacity">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="test-title text-center">
                        <h2>What Our Client Says</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 col-12">
                    <div class="testmonial-active owl-carousel">
                        @foreach ($review as $item)
                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>{{ $item->message }}</p>
                                <h2>{{ $item->name }}</h2>
                                <p>{{ $item->subject }}</p>
                            </div>
                            <div class="test-img2">
                                <img style="border-radius: 50%;" src="assets/images/test/1.png" alt="">
                            </div>
                        </div>
                            
                        @endforeach
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial-area end -->
    
@endsection