<?php

namespace App\Http\Controllers;

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
            return redirect()->back()->with('success','Product Add to chart');
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
}
