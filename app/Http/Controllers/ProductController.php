<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Media;
use App\Models\Product;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        $data['title'] = 'Produdcts';
        $data['table'] = Product::with(['category','brand'])->orderByDesc('id')->get();
        $data['category'] = Categories::all();
        $data['tags'] = Tags::all();
        $data['brand'] = Brand::all();
        return view('dashboard.products',$data);
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
//author
            $brand = Brand::where('name',$request->brand)->first();
            if(!$brand){
                $brand = Brand::create(['name'=>$request->brand]);
            }
            $foto = $request->file('foto');
            $name = Str::slug($request->product_name);
            $fotoImg= strtolower($name).'.'.$foto->getClientOriginalExtension();
            $path = 'images/product/';
            $foto->move(public_path($path), $fotoImg);
            $imagesMain = $path.$fotoImg;

            $tags = $request->tags;
            $tagList = [];
            foreach($tags as $t){
                // dd($t);
                if(!is_numeric($t)){
                    // find same;
                    $findTag = Tags::where('tag_name','like','%'.strtolower($t).'%')->first();
                    if(!$findTag){
                        $newTag = Tags::create(['tag_name'=>$t]);
                        $tagList[] = $newTag->id;
                    }else{
                        $tagList[] = $findTag->id;
                    }
                }else{
                    $tagList[] = (int)$t;
                }
            }
            // images
            $images = $request->file('images');
            foreach($images as $i => $image){

            // Store the image in the storage folder
                $name = Str::slug($request->product_name).'-'.$i+1;
                $filename= strtolower($name).'.'.$image->getClientOriginalExtension();
                $path = 'images/product/';
                $image->move(public_path($path), $filename);
                $imgSave = $path.$filename;
            
                Media::create([
                    'slug' => Str::slug($request->product_name),
                    'file'  => $imgSave,
                ]);
            }
           

            Product::create([
                'product_name'  => $request->product_name,
                'product_slug'  => Str::slug($request->product_name),
                'id_category'   => $request->category,
                'price'         => intval(preg_replace('/[^\d.]/', '', $request->price)),
                'description'   => $request->description,
                'tags'          => json_encode($tagList),
                'images'        => $imagesMain,
                'brand_id'      => $brand->id
            ]);
            DB::commit();
            return redirect()->back()->with('success','Product Created');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
