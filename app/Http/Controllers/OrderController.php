<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status,Request $request)
    {
        $orders = Order::where(['status'=>$status])->orderBy('id', 'DESC');
        if($request->search){
            $searchQuery=$request->search;
            $orders = $orders->where('full_name','like',"%$searchQuery%")
            ->orwhere('created_at','like',"%$searchQuery%");
        }
        $orders=$orders->paginate(8);
        return view('backend.orders.index', compact('orders'));
    } //


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
      
        $order = Order::find($request->orderId);

        if ($order) {
            $detail = Order::with(['products'])->where(['id'=>$request->orderId])->get()->first();
              
            // $order->id = OrderDetail::with()->where('id', $product->cat_id)->get()->first();
            return response()->json(['msg' => '', 'status' => true, 'data' => $detail]);
        } else {
            return response()->json(['msg' => '', 'status' => false, 'data' => null]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $status = $order->status;


        if ($order) {
            if (!(Auth::user()->store_id)) {
                $order->delete();

                $orders = Order::where(['status' => $status])->orderBy('id', 'DESC')->get();
                return view('backend.orders.index', compact('orders'));
            } else {
                $delete_price = 0;
                foreach ($order->orderDetail as $item) {
                    $product = Product::where('id', $item->product_id)->wherehas('user_categories', function ($qee) {
                        $qee->where('store_id', auth()->user()->store_id);
                    })->get()->first();

                    if ($product) {
                        $delete_price += $item->price;
                        $item->delete();
                    }
                }
                $past_val = $order->total_amount;
                $total_amount = $past_val - $delete_price;
                $order->update(['total_amount' => $total_amount]);

                $orders = Order::where(['status' => $status])->wherehas('products', function ($qe) {
                    $qe->wherehas('relatedProducts', function ($qee) {
                        $qee->where('cat_id', auth()->user()->store_id);
                    });
                })->orderBy('id', 'DESC')->get();
                return view('backend.orders.index', compact('orders'));
            }

            //return redirect()->route('backend.order.index')->with('success', 'Successfully Deleted order');
        } else {
            return back()->with('error', 'Data Not Found');
        }
        //

    }


    public function orderStatus(Request $request)
    {
        if ($request->status) {
            DB::table('orders')->where('id', $request->id)->update(['status' => $request->status]);
        } 
        return response()->json(['msg' => 'Successfully update', 'status' => true]);
    }
}
