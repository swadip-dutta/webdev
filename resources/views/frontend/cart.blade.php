@extends('frontend.master')

@section('cart')
active
@endsection

@section('title')
 Cart Page
@endsection

@section('content')
    
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
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
                   
                        
                    <form id="incrs_qut" action="{{ route('updatetocart') }}" method="POST">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="ptice">Color</th>
                                    <th class="ptice">Size</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grand_total = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                <tr class="cartpage">
                                    <td class="images"><img src="{{ asset('images/'.$cart->product->thumbnail) }}" alt="{{ $cart->product->title }}"></td>
                                    <td class="product"><a target="_blank" href="{{ route('SingleProduct', $cart->product->id) }}">{{ $cart->product->title }}</a></td>
                                    <td class="price unit_price{{ $cart->id }}" data-unit{{ $cart->id }}="{{ number_format($cart->product->price, 2) }}">${{ number_format($cart->product->price, 2) }}</td>
                                    <td class="color">{{ $cart->color->color_name }}</td>
                                    <td class="size">{{ $cart->size->size_name }}</td>
                                    


                                    <td class="cart-product-quantity" width="130px">
                                        <div class="input-group quantity">
                                            
                                            <div class="input-group-prepend decrement-btn changequty" style="position: absolute; z-index: 999; top: 18px; left: -28px;">
                                                <span style="height: 35px; width: 35px; text-align: center; line-height: 35px; font-size: 18px; cursor: pointer; color: #fff; background: #ef4836; position: absolute; top: 50%; left: 27px; transform: translateY(-51%); -webkit-transform: translateY(-51%); -moz-transform: translateY(-51%);" class="input-group-text">-</span>
                                            </div>
                                        

                                            <input name="quantity[]" style=" width: 120px; padding: 0px 35px; text-align: center; height: 35px; position: relative; background: #ccc; color: #0d0d0d; border: none;" type="text" class="qty-input form-control" maxlength="2" max="10" value="{{ $cart->quantity }}">
                                            <div class="input-group-append increment-btn changequty" style="position: absolute; z-index: 999; right: 35px;">
                                                <span style="top: 0; left: 0; height: 35px; width: 35px; text-align: center; line-height: 35px; font-size: 18px; cursor: pointer; color: #fff; background: #ef4836; position: absolute;" class="input-group-text">+</span>
                                            </div>
                                        </div>
                                    </td>


                                    @php
                                        $grand_total += ($cart->product->price * $cart->quantity)
                                    @endphp

                                    <td class="total tuin total_unit{{ $cart->id }}">${{ $cart->product->price * $cart->quantity }}</td>
                                    


                                
                                    <td class="remove"><a href="{{ route('CartProductDelete', $cart->id) }}"><i class="fa fa-times"></i></a></td>
                                    
                                </tr>

                                <input type="hidden" name="cart_id[]" value="{{ $cart->id }}">
                                @endforeach
                                
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button type="submit">Update Cart</button>
                                        </li>
                                        <li><a href="{{ route('Shop') }}">Continue Shopping</a></li>
                                    </ul>
                    </form>
                                <form action="{{ route('Cart') }}" method="get">
                                    <h3>Coupon</h3>
                                    <p>Enter Your Coupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" value="{{ $code ?? '' }}" name="coupon_code" placeholder="Coupon Code">
                                        <button>Apply Coupon</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <form action="{{ route('Checkout_Cart') }}" method="get">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        
                                        <li><span class="pull-left grand_total">Sub Total </span>${{ $new_in ?? 0 }}</li>
                                        <li><span class="pull-left">Coupon Discount </span>${{ $coupon_discount ?? 0 }}</li>
                                        <li><span class="pull-left grand_total"> Total </span>$ <span class="has">{{ $grand_total - $coupon_discount ?? 0 }}</span></li>
                                        <input type="hidden" name="coupon_discount" value="{{ $grand_total - $coupon_discount }}">
                                    </ul>
                                    <a href="{{route('Checkout') }}">Proceed to Checkout</a>
                                    <span>{{ Session::put('coupon_dis', ($grand_total - $coupon_discount)) }}</span>
                                </form>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
<!-- cart-area end -->
   

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





        
        @if(session('discount_pay'))
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('discount_pay') }}'
        })
        @endif






    })
</script>