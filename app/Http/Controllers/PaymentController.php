<?php

namespace App\Http\Controllers;

use App\attribute;
use App\Order;
use Cookie;
use App\Cart;
use App\shipping;
use Illuminate\Http\Request;
use Auth;
use Stripe;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\wishlist;
//Paypal
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        /** PayPal api context **/
        $paypal_conf = \Illuminate\Support\Facades\Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    function payment(Request $request){
        
        

        if($request->payment == 'card') {

        $shipping = new shipping;
        $shipping->user_id = Auth::id();
        $shipping->first_name = $request->first_name;
        $shipping->last_name = $request->last_name;
        $shipping->company = $request->company;
        $shipping->email = $request->email;
        $shipping->phone = $request->phone;
        $shipping->city_id = $request->city_id;
        $shipping->address = $request->address;
        $shipping->zipcode = $request->zipcode;
        
        $shipping->coupon_code = $request->coupon_code;
        $shipping->save();

        $cookie = Cookie::get('cookie_id');
        $carts = Cart::where('cookie_id', $cookie)->get();

        foreach ($carts as $cart) {

            $order = new Order;
            $order->shipping_id = $shipping->id;
            $order->product_id = $cart->product_id;
            $order->color_id = $cart->color_id;
            $order->size_id = $cart->size_id;
            $order->product_unit_price = $cart->product->price;
            $order->quantity = $cart->quantity;
            $order->save();

            $attr = attribute::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id);
            if($attr->exists()){
                $attr->decrement('quantity', $cart->quantity);
            };
            
            $cart->delete();
        }





        
        

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create ([
    
                    "amount" => 100 * 100,
    
                    "currency" => "usd",
    
                    "source" => $request->stripeToken,
    
                    "description" => "Test payment from ES WEB DEV 2001" 
    
            ]);

            $Payment_Update = Shipping::findOrFail($shipping->id);
            $Payment_Update->payment_status = 1;
            $Payment_Update->save();

            
        }
        elseif($request->payment == 'bank'){
            return "bank";
        }
        elseif($request->payment == 'paypal'){
            $payer = new Payer();
        $payer->setPaymentMethod('paypal');

    	$item_1 = new Item();

        $item_1->setName('Product 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(500);

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(400);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Enter Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(url('/status'))
            ->setCancelUrl(url('/status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));            
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect('paywithpaypal');                
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect('paywithpaypal');                
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {            
            return Redirect::away($redirect_url);
        }

        \Session::put('error','Unknown error occurred');
        return Redirect('paywithpaypal');    
        
        }
        elseif($request->payment == 'cash'){
            


            $shipping = new shipping;
            $shipping->user_id = Auth::id();
            $shipping->first_name = $request->first_name;
            $shipping->last_name = $request->last_name;
            $shipping->company = $request->company;
            $shipping->email = $request->email;
            $shipping->phone = $request->phone;
            $shipping->city_id = $request->city_id;
            $shipping->address = $request->address;
            $shipping->zipcode = $request->zipcode;
            
            $shipping->coupon_code = $request->coupon_code;
            $shipping->save();
    
            $cookie = Cookie::get('cookie_id');
            $carts = Cart::where('cookie_id', $cookie)->get();
    
            foreach ($carts as $cart) {
    
                $order = new Order;
                $order->shipping_id = $shipping->id;
                $order->product_id = $cart->product_id;
                $order->color_id = $cart->color_id;
                $order->size_id = $cart->size_id;
                $order->product_unit_price = $cart->product->price;
                $order->quantity = $cart->quantity;
                $order->save();
    
                $attr = attribute::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id);
                if($attr->exists()){
                    $attr->decrement('quantity', $cart->quantity);
                };
                
                $cart->delete();
            }
    
    
    
                $Payment_Update = Shipping::findOrFail($shipping->id);
                $Payment_Update->payment_status = 2;
                $Payment_Update->save();

        }
        else{
            return "Payment Select Koro";
        }

        $order = Order::where('shipping_id', 17)->get();
        Mail::to(Auth::user()->email)->send(new OrderShipped($order));

        return "Payment Successfully";
    }
}
