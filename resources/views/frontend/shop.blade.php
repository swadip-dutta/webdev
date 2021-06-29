@extends('frontend.master')

@section('shop')
active
@endsection

@section('title')
 Shop Page
@endsection

@section('content')


    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="{{ route('front') }}">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="product-menu">
                        <ul class="nav justify-content-center">
                            <li>
                                <a class="active" data-toggle="tab" href="#all">All product</a>
                            </li>

                            @foreach ($cats as $cat)

                            <li style="margin-bottom: 10px;">
                                <a data-toggle="tab" href="#chair{{ $cat->id }}">{{ $cat->category_name }}</a>
                            </li>
                                
                            @endforeach

                            
                           
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">

                        @foreach ($products as $key => $item)

                        <li class="col-xl-3 col-lg-4 col-sm-6 col-12 {{ $products->count() }} @if($key + 1 > 0) moreload @endif">
                            <div class="product-wrap">
                                <div class="product-img">
                                    <span>Sale</span>
                                    <img src="{{ asset('images/'.$item->thumbnail) }}" alt="">
                                    <div class="product-icon flex-style">
                                        <ul>
                                            <li><a data-toggle="modal" data-target="#exampleModalCenter" href="{{ route('SingleProduct', $item->id) }}"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="{{ route('WishAdd', [$item->id, $item->category_id, $item->subcategory_id, $item->brand_id]) }}"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="{{ route('SingleProduct', $item->id) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{ route('SingleProduct', $item->id) }}">{{ $item->title }}</a></h3>
                                    <p class="pull-left">${{ $item->price }}</p>
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
                            
                        @endforeach

                        

                        <li class="col-12 text-center">
                            <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                        </li>
                    </ul>
                </div>
                
                @foreach ($cats as $ct)
                
                <div class="tab-pane" id="chair{{ $ct->id }}">
                    <ul class="row">

                        @foreach ($products->where('category_id', $ct->id) as $item)

                        <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                            <div class="product-wrap">
                                <div class="product-img">
                                    <span>Sale</span>
                                    <img src="{{ asset('images/'.$item->thumbnail) }}" alt="">
                                    <div class="product-icon flex-style">
                                        <ul>
                                            <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{ route('SingleProduct', $item->id) }}">{{ $item->title }}</a></h3>
                                    <p class="pull-left">${{ $item->price }}</p>
                                    <ul class="pull-right d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-half-o"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                            
                        @endforeach

                       

                    </ul>
                </div>

                @endforeach
                
            </div>
        </div>
    </div>
    <!-- product-area end -->



    
@endsection