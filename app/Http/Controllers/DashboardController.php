<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['title'] =  'Dashboard';
        $data['product'] = Product::orderByDesc('id')->limit(5)->get();
        $data['order'] = ''; //wait
        return view('dashboard.index',$data);
    }
}
