<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\SpecialProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['title'] = '';
        $category = Categories::all();
        $data['category_all'] = $category;
        $data['product_all'] = Product::with(['category'])->orderByDesc('id')->get();
        $data['special'] = SpecialProduct::with('product')->orderByDesc('id')->get();
        return view('home',$data);
    }
}
