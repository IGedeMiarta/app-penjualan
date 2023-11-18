<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\UserChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function chart(){
        $data['chart'] = UserChart::with('product','product.author','product.category')->where('user_id',Auth::id())->get();
        // dd($data);
        return view('home.chart',$data);
    }
    public function chartAdd(Request $request){
        $product = Product::where('product_slug',$request->product)->first();
        $price = $request->_xcode / 111111;
        if(!$product){
            return redirect()->back()->with('error','Product Not Found');
        }
        $checkAlredry = UserChart::where(['product_id'=>$product->id,'user_id'=>auth()->user()->id])->first();
        if($checkAlredry){
            return redirect()->back()->with('success','Product alredy on chart');
        }
        DB::beginTransaction();
        try {
            UserChart::create([
                'user_id'       => auth()->user()->id,
                'product_id'    => $product->id,
                'price'         => $price,
                'qty'           => 1,
                'sum'           => $price
            ]);
            DB::commit();
            return redirect()->back()->with('success','Product added to chart');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
    public function chartDel($id){
        $chart = UserChart::find($id);
        $chart->delete();
        return redirect()->back()->with('success','Product in chart deleted');
    }
    public function chartDelAll(){
        UserChart::where('user_id',auth()->user()->id)->delete();
        return redirect()->back()->with('success','All chart deleted');
    }

    public function trasaction(Request $request){
        $products = $request->input('product');
        $prices = $request->input('price');
        $qtys = $request->input('qty');
        $totals = $request->input('total');
        DB::beginTransaction();
        $inv = Inv();
        try {
            $createOrder = new Order();
            $createOrder->Invoice = $inv;
            $createOrder->customer = auth()->user()->id;
            $createOrder->amount = $request->amount;
            $createOrder->status = 1;
            $createOrder->save();

            foreach ($products as $key => $product) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $createOrder->id;
                $orderDetail->product_id = $product;
                $orderDetail->qty = $qtys[$key];
                $orderDetail->price = $prices[$key];
                $orderDetail->total = $totals[$key];
                $orderDetail->save();
            }
            DB::commit();
            UserChart::where('user_id',auth()->user()->id)->delete();
            return redirect()->back()->with('success','Trasaction Create, check email for details');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
    public function invoiceAll(){
        $data['title'] = 'Invoice';
        $data['table'] = Order::with('details','details.product')->where('customer',auth()->user()->id)->get();
        // dd($data);
        return view('home.invoice',$data);
    }

    public function invoice($inv){
        $order = Order::with('details','details.product')->where('customer',auth()->user()->id)->where('Invoice',$inv)->first();
        $data['title'] = 'Invoice: #'.$order->Invoice;
        $data['order'] = $order;
        return view('home.invoice-detail',$data);
    }
}
