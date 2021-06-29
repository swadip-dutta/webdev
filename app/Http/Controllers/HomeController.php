<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Blog;
use App\Comment;

use PDF;
use Carbon\Carbon;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\categoryImport;
use App\message;
use App\ProductReview;
use App\shipping;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class HomeController extends Controller
{
    use SoftDeletes;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        for($i = 1; $i < 7; $i++){
            $day[] = Carbon::now()->subDays($i)->format('D');
        }
        
        $this_day = Carbon::now()->format('d M y');

        $today = Order::wheredate('created_at', Carbon::now())->count();
        $yesterday = Order::wheredate('created_at', Carbon::yesterday())->count();
        $seven_days_ago = Order::wheredate('created_at', Carbon::now()->subDays(7))->count();


        $today_sale = Order::wheredate('created_at', Carbon::now())->sum(DB::raw('quantity * product_unit_price'));

        

        $ordersLastWeek = Order::select('created_at')
                        ->where('created_at', '>', now()->subWeek()->startOfWeek())
                        ->where('created_at', '<', now()->subWeek()->endOfWeek())
                        ->sum(DB::raw('quantity * product_unit_price'));



        $ordersLastMonth = Order::select('created_at')
                        ->where('created_at', '>', now()->subDay()->startOfMonth())
                        ->where('created_at', '<', now()->subDay()->endOfMonth())
                        ->sum(DB::raw('quantity * product_unit_price'));


        $ordersLastYear = Order::select('created_at')
                        ->where('created_at', '>', now()->subDay()->startOfYear())
                        ->where('created_at', '<', now()->subDay()->endOfYear())
                        ->sum(DB::raw('quantity * product_unit_price'));                
        



        $this_month_sale = Order::wheredate('created_at', Carbon::now()->subDays(30)->startOfDay())->sum(DB::raw('quantity * product_unit_price'));
        $this_year_sale = Order::wheredate('created_at', Carbon::now()->subDays(365)->startOfYear())->sum(DB::raw('quantity * product_unit_price'));

        $comment = ProductReview::wheredate('created_at', Carbon::now())->get('massage')->count();






        // Monthly Count For Bar
        $data = shipping::selectRaw('MONTH(created_at) month, COUNT(*) as count')
        ->groupBy('month')->get();

        
        

        $something = shipping::get(['id', 'created_at'])->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m');
      });


      $jan = shipping::where('created_at', '>', '2021-01-01')
                        ->where('created_at', '<', '2021-01-31')
                        ->count();


        $feb = shipping::where('created_at', '>', '2021-02-01')
        ->where('created_at', '<', '2021-02-28')
        ->count();



        $mar = shipping::where('created_at', '>', '2021-03-01')
        ->where('created_at', '<', '2021-03-31')
        ->count();


        $apr = shipping::where('created_at', '>', '2021-04-01')
        ->where('created_at', '<', '2021-04-30')
        ->count();


        $may = shipping::where('created_at', '>', '2021-05-01')
        ->where('created_at', '<', '2021-05-31')
        ->count();

        $jun = shipping::where('created_at', '>', '2021-06-01')
        ->where('created_at', '<', '2021-06-30')
        ->count();



        $jul = shipping::where('created_at', '>', '2021-07-01')
        ->where('created_at', '<', '2021-07-31')
        ->count();

        $aug = shipping::where('created_at', '>', '2021-08-01')
        ->where('created_at', '<', '2021-08-31')
        ->count();


        $sep = shipping::where('created_at', '>', '2021-09-01')
        ->where('created_at', '<', '2021-09-30')
        ->count();

        $oct = shipping::where('created_at', '>', '2021-10-01')
        ->where('created_at', '<', '2021-10-31')
        ->count();

        $nov = shipping::where('created_at', '>', '2021-11-01')
        ->where('created_at', '<', '2021-11-30')
        ->count();

        $dec = shipping::where('created_at', '>', '2021-12-01')
        ->where('created_at', '<', '2021-12-31')
        ->count();



    


       
        return view('backend.dashboard', [
            'today' => $today,
            'this_day' => $this_day,
            'yesterday' => $yesterday,
            'seven_days_ago' => $seven_days_ago,
            'today_sale' => $today_sale,
            'this_month_sale' => $this_month_sale,
            'this_year_sale' => $this_year_sale,
            'comment' => $comment,
            'data' => $data,
            'ordersLastWeek' => $ordersLastWeek,
            'ordersLastMonth' => $ordersLastMonth,
            'ordersLastYear' => $ordersLastYear,
            'something' => $something,
            'jan' => $jan,
            'feb' => $feb,
            'mar' => $mar,
            'apr' => $apr,
            'may' => $may,
            'jun' => $jun,
            'jul' => $jul,
            'aug' => $aug,
            'sep' => $sep,
            'oct' => $oct,
            'nov' => $nov,
            'dec' => $dec,

     
            

        ]);

        
    }

    // USER FUNCTION

    function users() {
        $user_count = User::count();
        $users = User::orderBy('name','asc')->paginate();
        return view('backend.users.users', [
            'users' => $users,
            'user_count' => $user_count 
        ]);
    }

    function UsersEdit($id){
        return view('backend.users.user_edit', [
            'users' =>User::where('id', $id)->first()
        ]);
    }

    function UsersUpdate(Request $request){
        $user = User::findOrFail($request->user_id);

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            
            $ext = Str::random(10).'.'.$image->getClientOriginalExtension();

            $old_img_location = public_path('Pro_images/'. $user->id . '/'. $user->images);
            if (file_exists($old_img_location)) {
                unlink($old_img_location);
            }

            $new_location = public_path('Pro_images/')
            . $user->id . '/';

                File::makeDirectory($new_location, $mode = 0777, true, true);

                Image::make($image)->save($new_location. $ext);

        

            $user->images = $ext;
        }




            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();

            return "User Update Successfull";
        
    }

    // ORDERS FUNCTION

    function orders() {

        $order_count = Order::count();

        return view('backend.orders.orders', [
            'orders' => Order::latest()->paginate(10),
            'order_count' => $order_count,
        ]);
    }

    function ExcelDownload(){

        return Excel::download(new OrderExport, 'orders.xlsx');
    }

    public function import(Request $request) 
    {
        Excel::import(new categoryImport, $request->file('excel'));
        
        return redirect('/')->with('success', 'All good!');
    }

    function SelectedDateExcelDownload(Request $request){
        $from = $request->start;
        $to = $request->end;

        return Excel::download(new OrderExport($from, $to), 'orders.xlsx');

    }

    function PDFDownload() {
        $orders = Order::all();
        $pdf = PDF::loadView('exports.pdf', [
            'orders' => $orders
        ]);
        return $pdf->download('invoice.pdf');
    }


    function destroy($id)
    {
        
        $blog = Blog::findOrFail($id);

        $blog->delete();
        return back();
    }


    function Comments(Request $request)
    {
        
        $comment = new comment;
        $comment->user_id = Auth::id();
        $comment->blog_id = $request->blog_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->save();
        return back();
    }



    function UserReview(Request $request){

        if(ProductReview::where('user_id', Auth::id())->where('product_id', $request->product_id)->exists()){
            return back()->with('review', 'Sorry!! You have allready review this product');
        }
        else{
          $reviews = new ProductReview;
          $reviews->user_id = Auth::id();
          $reviews->product_id = $request->product_id;
          $reviews->rating = $request->rating;
          $reviews->name = $request->name;
          $reviews->email = $request->email;
          $reviews->massage = $request->massage;
          $reviews->save();
          return back();
        }
       
    }


    function ShippingList(){

        $shippings = shipping::latest()->paginate(10);

        return view('backend.shipping.shipping-list', [
            'shippings' => $shippings
        ]);
    }

    function ShippingDelete($id){
        $shipping_del = shipping::findOrFail($id);
        $shipping_del->delete();
        return back();
    }

    function ShippingSearch(Request $request){
        $shipping = shipping::query();

        if($request->q){
            $shipping->where('phone','LIKE', "%$request->q%");
        }

        return view('backend.shipping.search-view', [
            'shipping' => $shipping->get()
        ]);

        // echo $shipping->get();
    }

    function ShippingEdit($id){
        return view('backend.shipping.shipping-edit', [
            'shipping' => shipping::where('id', $id)->first()
        ]);
    }


    function ShippingUpdate(Request $request){
        $shipping = shipping::findOrFail($request->shipping_id);

        // $shipping = new shipping;
        
        $shipping->payment_status = $request->payment_status;
        $shipping->status = $request->status;

        

    
        $shipping->save();

        return "Status Update Successful";

    }


    function AllMessage(){
        $msg = message::latest()->paginate();
        return view('backend.message.all_message', [
            'msg' => $msg
        ]);
    }


    function DeleteMessage($id){
        $msg_del = message::findOrFail($id);
        $msg_del->delete();
        return back();
    }

    
}
