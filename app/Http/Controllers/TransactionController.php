<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\UserChart;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class TransactionController extends Controller
{
    public function chart(){
        $data['chart'] = UserChart::with('product','product.brand','product.category')->where('user_id',Auth::id())->get();
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
            $createOrder = new Transaction();
            $createOrder->Invoice = $inv;
            $createOrder->customer = auth()->user()->id;
            $createOrder->amount = $request->amount;
            $createOrder->status = 1;
            $createOrder->save();

            foreach ($products as $key => $product) {
                $orderDetail = new TransactionDetail();
                $orderDetail->transaction_id	 = $createOrder->id;
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
        $data['table'] = Transaction::with('details','details.product')->where('customer',auth()->user()->id)->orderBy('status','ASC')->orderBy('id','desc')->limit(5)->get();


        // dd($data);
        return view('home.invoice',$data);
    }

    public function invoice($inv){
        $order = Transaction::with('details','details.product')->where('customer',auth()->user()->id)->where('Invoice',$inv)->first();
        
        if(!$order){
            return redirect()->back()->with('error','Inoice not found');
        }
        $data['title'] = 'Invoice: #'.$order->Invoice;
        $data['order'] = $order;
        $view = view('home.invoice-detail',$data)->render();
        // $view = view('test-inv',$data)->render();
        return $view;
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream();

        // return Pdf::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
        return Pdf::loadHTML($view)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf')->stream('download.pdf');
        // $pdf = Pdf::loadView('home.invoice-detail',$data);
        // return $pdf->download('laporan-pegawai-pdf');

        return view('home.invoice-detail',$data);
    }
    public function adminView(Request $request){
        $trx = Transaction::with('customers','details','details.product');
        if($request->filter){
           
            //switch case
            switch ($request->filter) {
                case 'daily':
                    $title = 'Filter By '. $request->filter;
                    $today = Carbon::now()->toDateString();
                    $trx = $trx->whereDate('created_at', $today);
                    break;
                case 'weekly':
                    $title = 'Filter By '. $request->filter;
                    $startDate = Carbon::now()->subWeek()->startOfDay();
                    $endDate = Carbon::now()->endOfDay();
                    $trx = $trx->whereBetween('created_at', [$startDate, $endDate]);
                    break;
                case 'year':
                    $title = 'Filter By '. $request->filter;
                    $currentYear = Carbon::now()->year;
                    $trx = $trx->whereYear('created_at', $currentYear);
                    break;
                default:
                    $title = 'No Filter';
                    break;
            }
        }else{
            $title = 'List';
        }
        $trx = $trx->latest()->get();
        $data['title'] = 'Transaction ' .$title;
        $data['table']= $trx;
        return view('dashboard.transaction',$data);
    }
    public function adminUpdate(Request $request, $id){
        $trx = Transaction::find($id);
        if(!$trx){
            return redirect()->back()->with('error','Transaction not found');
        }
        $trx->update($request->all());
        return redirect()->back()->with('success','Transaction updated');

    }
}
