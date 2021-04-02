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
use App\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
        

        $today = Order::wheredate('created_at', Carbon::now())->count();
        $yesterday = Order::wheredate('created_at', Carbon::yesterday())->count();
        $seven_days_ago = Order::wheredate('created_at', Carbon::now()->subDays(7))->count();


        $today_sale = Order::wheredate('created_at', Carbon::now())->sum(DB::raw('quantity * product_unit_price'));
        $this_week_sale = Order::wheredate('created_at', Carbon::now()->subWeekdays(7))->sum(DB::raw('quantity * product_unit_price'));
        $this_month_sale = Order::wheredate('created_at', Carbon::now()->subMonth())->sum(DB::raw('quantity * product_unit_price'));
        $this_year_sale = Order::wheredate('created_at', Carbon::now()->subDays(365))->sum(DB::raw('quantity * product_unit_price'));

        return view('backend.dashboard', [
            'today' => $today,
            'yesterday' => $yesterday,
            'seven_days_ago' => $seven_days_ago,
            'today_sale' => $today_sale,
            'this_week_sale' => $this_week_sale,
            'this_month_sale' => $this_month_sale,
            'this_year_sale' => $this_year_sale,

        ]);

        
    }

    function users() {
        $user_count = User::count();
        $users = User::orderBy('name','asc')->paginate();
        return view('backend.users.users', [
            'users' => $users,
            'user_count' => $user_count 
        ]);
    }

    function orders() {

        return view('backend.orders.orders', [
            'orders' => Order::latest()->paginate(10)
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

    
}
