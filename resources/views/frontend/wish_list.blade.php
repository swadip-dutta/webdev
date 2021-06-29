@extends('frontend.master')

@section('name')
    
@endsection

@section('title')
 Wish Page
@endsection

@section('content')
    
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Wish List</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Wish List</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                   
                        
                    <form id="incrs_qut" action="{{ route('WishProductUpdate') }}" method="post">
                        @csrf
                        

                                <div class="row">
                                    <div class="col-12">
                                        <form action="">
                                            <table class="table-responsive cart-wrap">
                                                <thead>
                                                    <tr>
                                                        <th class="images">Image</th>
                                                        <th class="product">Product</th>
                                                        <th class="ptice">Price</th>
                                                        <th class="stock">Stock Stutus </th>
                                                        <th class="addcart">Buy</th>
                                                        <th class="remove">Remove</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($wish as $wish)

                                                    <tr>
                                                        <td class="images"><img src="{{ asset('images/'.$wish->product->thumbnail) }}" alt="{{ $wish->product->title }}"></td>
                                                        <td class="product"><a href="{{ route('SingleProduct', $wish->product->id) }}">{{ $wish->product->title }}</a></td>
                                                        <td class="price">${{ number_format($wish->product->price, 2) }}</td>
                                                        <td class="stock">

                                                            @foreach ($attr as $qty)
                                                                
                                                            
                                                            @endforeach
                                                            @if ($wish->product_id == $qty->quantity > 2)
                                                                In Stock
                                                            @else
                                                                Out of Stock
                                                            @endif
                                                            

                                                        </td>
                                                        <td class="addcart"><a href="{{ route('SingleProduct', $wish->product->id) }}" class="btn  @if ($wish->product_id == $qty->quantity < 2) disabled @endif" style="line-height: 26px; overflow: hidden;" aria-disabled="true">Buy</a></td>
                                                        <td class="remove"><a href="{{ route('WishProductDelete', $wish->id) }}"><i class="fa fa-times"></i></a></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>


                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        
                                        <li><a href="{{ route('Shop') }}">Continue Shopping</a></li>
                                    </ul>
                    
                                
                                </div>
                            </div>
                            {{-- <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <form action="{{ route('Checkout_Cart') }}" method="get">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        
                                        <li><span class="pull-left grand_total">Sub Total </span>${{ $grand_total ?? 0 }}</li>
                                        
                                        <li><span class="pull-left grand_total"> Total </span>$ <span class="has">{{ $grand_total ?? 0 }}</span></li>
                                        <input type="hidden" name="coupon_discount" value="{{ $grand_total }}">
                                    </ul>
                                    <a href="{{route('Checkout') }}">Proceed to Checkout</a>
                                    <span>{{ Session::put('coupon_dis', ($grand_total)) }}</span>
                                </form>
                                </div>
                            </div> --}}

                        </form>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
    <!-- start social-newsletter-section -->
   

@endsection



<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function(){

        $('.increment-btn').click(function (e) {
            e.preventDefault();
            var incre_value = $(this).parents('.quantity').find('.qty-input').val();
            var value = parseInt(incre_value, 10);
            value = isNaN(value) ? 0 : value;
            if(value<10){
                value++;
                $(this).parents('.quantity').find('.qty-input').val(value);
            }

        });

        $('.decrement-btn').click(function (e) {
            e.preventDefault();
            var decre_value = $(this).parents('.quantity').find('.qty-input').val();
            var value = parseInt(decre_value, 10);
            value = isNaN(value) ? 0 : value;
            if(value>1){
                value--;
                $(this).parents('.quantity').find('.qty-input').val(value);
            }
        });




        $('.changequty').click(function(){
            document.getElementById('incrs_qut').submit();
        });


        var x = document.getElementById("size").options[2].disabled = true;

        
        @if(session('discount_pay'))
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('discount_pay') }}'
        })
        @endif






    })
</script>