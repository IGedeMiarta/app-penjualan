<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SpecialProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Special Produk';
        $data['products'] = DB::table('products')
                ->leftJoin('special_products', 'products.id', '=', 'special_products.id_product')
                ->whereNull('special_products.id_product')
                ->select('products.*')
                ->get();
        $data['table'] = SpecialProduct::with('product')->orderByDesc('id')->get();
        return view('dashboard.special',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $disc =  intval(preg_replace('/[^\d.]/', '', $request->disc));
            $finn =  intval(preg_replace('/[^\d.]/', '', $request->final));
            dd($finn);
            SpecialProduct::create([
                'id_product'    => $request->product,
                'disc'          => $disc,
                'final_amount'  => $finn
            ]);
            DB::commit();
            return redirect()->back()->with('success','Special Product Created');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialProduct $specialProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialProduct $specialProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecialProduct $specialProduct)
    {
        $specialProduct->update([
            'disc'          => $request->disc,
            'final_amount'  => intval(preg_replace('/[^\d.]/', '', $request->final)),
            'status'        => $request->status
        ]);
        return redirect()->back()->with('success','Special Product Created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialProduct $specialProduct)
    {
        $specialProduct->delete();
        return redirect()->back()->with('success','Special Product Deleted');

    }
}
