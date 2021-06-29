@extends('frontend.master')

@section('search')
    active
@endsection

@section('title')
 Search Page
@endsection

@section('content')
        <!-- .breadcumb-area start -->
        <div class="breadcumb-area bg-img-4 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcumb-wrap text-center">
                            <h2>All product</h2>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><span>All product</span></li>
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
                            </ul>
                        </div>
                    </div>
                </div>





                <ul class="row">

                    @foreach ($all_product as $item)
                    
                    <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
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
    
                
                </ul>






                
            </div>
        </div>
    </div>
</div>
        <!-- product-area end -->
@endsection