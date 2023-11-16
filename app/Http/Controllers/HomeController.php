<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Media;
use App\Models\Product;
use App\Models\SpecialProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['title'] = '';
        $data['category_all'] = Categories::all();
        $data['product_all'] = Product::with(['category'])->orderByDesc('id')->get();
        $data['special'] = SpecialProduct::with('product')->orderByDesc('id')->get();
        return view('home.main',$data);
    }

    public function product($slug){
        $data['title'] = 'Product';
        $product = Product::with('author')->where('product_slug',$slug)->first();
        $details = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $product->description);
        $details = nl2br($details);
        $data['product'] = $product;
        $data['details'] = $details;
        $data['images'] = Media::where('slug',$product->product_slug)->get();
        $data['related'] = Product::where('id_category',$product->id_category)->whereNot('id',$product->id)->limit(5)->orderByDesc('id')->get();
        // dd($data);
        return view('home.product',$data);
    }
    public function author($id){
        $data['title'] = 'Product';
        $product = Product::with('author')->where('author_id',$id)->first();
        $details = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $product->description);
        $details = nl2br($details);
        $data['product'] = $product;
        $data['details'] = $details;
        $data['images'] = Media::where('slug',$product->product_slug)->get();
        $data['related'] = Product::where('id_category',$product->id_category)->whereNot('id',$product->id)->limit(5)->orderByDesc('id')->get();
        // dd($data);
        return view('home.product',$data);
    }
    public function catalog(Request $request){
        $data['title'] = 'Catalog';
        $data['catalog'] = Product::with('category')->paginate(4);
        if($request->search){
            $data['catalog'] = Product::with('category')->where('product_name','LIKE','%'.$request->search.'%')->paginate(4);
        }
        if($request->category){
            $catagory = Categories::where('category_slug',$request->category)->first();
            $data['catalog'] = Product::with('category')->where('id_category',$catagory->id)->paginate(4);
        }
        if($request->search && $request->category){
            $catagory = Categories::where('category_slug',$request->category)->first();
            $data['catalog'] = Product::with('category')
            ->where('id_category',$catagory->id)
            ->where('product_name','LIKE','%'.$request->search.'%')
            ->paginate(4);
        }

        $data['related'] = Product::limit(5)->orderByDesc('id')->paginate(5);
        return view('home.catalog',$data);
    }
}
