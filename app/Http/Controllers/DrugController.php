<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Auth;
use App\User;
use App\Drug;
use Illuminate\Http\Request;
use App\Cart;
use App\Order;
use App\Report;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;
use Session;


class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $status = request('status'); 
        $cat = request('cat'); 
        $error = request('error');
        $drugs = Drug::where('deleted_at', NULL)->where('quantity', '>=', 1)->get();
        $today = Carbon::Today();
        $about_to_expire = $today->subDays(29); 
        #return $about_to_expire;
        $sid = request('id');
        if (isset($sid)) {
            $report = Report::findOrFail($sid);
            $prescription = $report->prescription;
            $unique_id = $report->unique_id;

          return view('admin.alldrugs', compact('status', 'error', 'drugs', 'today', 'about_to_expire', 'prescription', 'unique_id', 'sid'));
        }
        elseif (isset($cat)) {
          $drugs = Drug::where('deleted_at', NULL)->where('quantity', '>=', 1)->where('category', $cat)->get();
          return view('admin.alldrugs', compact('status', 'error', 'drugs', 'today', 'about_to_expire'));
        }
        else
        {
            return view('admin.alldrugs', compact('status', 'error', 'drugs', 'today', 'about_to_expire'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Drug::create($request->all());
        $status = "Drug Saved Successfully";
        return redirect()->route('alldrugs', array('status' => $status));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function show(Drug $drug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function edit(Drug $drug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drug $drug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Drug::destroy($id);
        return back();
    }

    public function addcart(Request $request, $id)
    {
      
      $sid = request('sid');
      $product = Drug::find($id); 
      if ($product->quantity<=1) {
        $error = "You no longer have this medicine, restock this product and try again";
        return redirect()->route('alldrugs', array('error' => $error));
      }
      else{
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        $request->session()->push('product_id', $id);
        $request->session()->push('report', $sid);
        return back();
        }
    }

    public function getReduceByOne($id)
    {
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->reduceByOne($id);
      if (count($cart->items) > 0) {
        Session::put('cart', $cart);
        return back();
      }
      else{
        Session::forget('cart');
        return redirect()->route('alldrugs');
      }
    }


    public function getRemoveItem($id)
    {
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->removeItem($id);

      if (count($cart->items) > 0) {
        Session::put('cart', $cart);
        return back();
      }
      else{
        Session::forget('cart');
        return redirect()->route('alldrugs');
      }
    }

    public function shoppingcart()
    {
        if (!Session::has('cart')) {
            return view('admin.cart');
        }
         
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('admin.cart', ['products' => $cart->items, 'totalPrice' =>$cart->totalPrice]);
    }


    public function checkout(Request $request)
    {
      function random_num($size) {
        $alpha_key = '';
        $keys = range('A', 'Z');

        for ($i = 0; $i < 2; $i++) {
          $alpha_key .= $keys[array_rand($keys)];
        }

        $length = $size - 2;

        $key = '';
        $keys = range(0, 9);

        for ($i = 0; $i < $length; $i++) {
          $key .= $keys[array_rand($keys)];
        }

        return $alpha_key . $key;
      }
      $payment_id = 'I-'.random_num(8);

      if (!Session::has('cart')) {
        return redirect()->route('alldrugs');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      
      $patient_id = "Visitor";

      $order = new Order();
      $order->cart = serialize($cart);  
      
      $report_id  = session()->get('report');
      
      if (empty($report_id)) {
        foreach ($report_id as $key) {
          $report = Report::findOrFail($key);
          $report->prescription_billed = "Yes";
          $report->update() ;
        }
      }
      
      //return $request;
      $all_product_id = session()->get('product_id');
      foreach ($all_product_id as $key) {
        $drug= Drug::findOrFail($key);
        $drug->quantity = $drug->quantity - 1;
        $drug->update() ;
      }

      $order->totalPrice= $cart->totalPrice;   
      $order->agent = Auth::user()->unique_id;
      $order->patient_id = $patient_id;
      $order->mop = $request->mop;
      $order->payment_id = $payment_id;
        

      $order->save();




      Session::forget('cart');
      Session::forget('report');
      Session::forget('product_id');
      return redirect()->route('alldrugs');
    }


    public function orders()
    {
      $today = request('today'); 
      $week = request('week'); 
      $month = request('month'); 
      $year = request('year'); 

      $todaynow = Carbon::Today();
      if (isset($today)) {
        $orders = Order::select(DB::raw('*'))
                  ->whereRaw('Date(created_at) = CURDATE()')->get(); 
      }
      elseif (isset($week)) {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        $orders = Order::whereBetween('orders.created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
        ->get();
      }
      elseif (isset($month)) {
        $currentMonth = date('m');
        $orders = Order::where('deleted_at', NULL)->whereRaw('MONTH(created_at) = ?',[$currentMonth])->get();
      }
      elseif (isset($year)) {
        $currentYear = '20'.date('y');
        $orders = Order::where('deleted_at', NULL)->whereRaw('YEAR(created_at) = ?',[$currentYear])->get();
      }
      else
      {
        $orders = Order::where('deleted_at', NULL)->get();  
      }

      $orders->transform(function($order, $key){
          $order->cart = unserialize($order->cart);
          return $order;
      });
      return view('admin.orders', ['orders' => $orders]);
    }

    public function prescription()
    {
        $labs = Report::where('prescription', '!=', NULL)->where('prescription_billed', NULL)->where('deleted_at', NULL)->get(); 
        
        return view('admin.prescription', ['labs' => $labs]);
    }

    public function vieworders()
    {
      $pid = request('pid'); 
      $orders = Order::where('payment_id', $pid)->first();
      $totalPrice = $orders->totalPrice;
      $order = unserialize($orders->cart);
      $orderss =  $order->items;

      //return $orderss;
      return view('admin.vieworders', compact('orderss', 'totalPrice'));
      //return view('admin.vieworders', ['orderss' => $orderss]);

    }

    public function drugsale()
    {
      $todayorders = DB::table('orders')->select(DB::raw('*'))
        ->whereRaw('Date(created_at) = CURDATE()')->sum('totalPrice');

      Carbon::setWeekStartsAt(Carbon::SUNDAY);
      $weekorders = DB::table('orders')->whereBetween('orders.created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->sum('totalPrice');

      $currentMonth = date('m');
      $monthorders = Order::where('deleted_at', NULL)->whereRaw('MONTH(created_at) = ?',[$currentMonth])->sum('totalPrice');

      $currentYear = '20'.date('y');
      $yearorders = Order::where('deleted_at', NULL)->whereRaw('YEAR(created_at) = ?',[$currentYear])->sum('totalPrice');

      $today = request('today'); 
      $week = request('week'); 
      $month = request('month'); 
      $year = request('year'); 

      $todaynow = Carbon::Today();
      if (isset($today)) {
        $orders = Order::select(DB::raw('*'))
                  ->whereRaw('Date(created_at) = CURDATE()')->get(); 
      }
      elseif (isset($week)) {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        $orders = Order::whereBetween('orders.created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
        ->get();
      }
      elseif (isset($month)) {
        $currentMonth = date('m');
        $orders = Order::where('deleted_at', NULL)->whereRaw('MONTH(created_at) = ?',[$currentMonth])->get();
      }
      elseif (isset($year)) {
        $currentYear = '20'.date('y');
        $orders = Order::where('deleted_at', NULL)->whereRaw('YEAR(created_at) = ?',[$currentYear])->get();
      }
      else
      {
        $orders = Order::where('deleted_at', NULL)->get();  
      }

      $orders->transform(function($order, $key){
          $order->cart = unserialize($order->cart);
          return $order;
      });

      return view('admin.drugsale', compact('todayorders', 'weekorders', 'monthorders', 'yearorders', 'orders', 'today', 'week', 'year', 'month'));
    }
}
