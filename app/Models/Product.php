<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function category(){
        return $this->belongsTo(Categories::class,'id_category');
    }
    public function tags(){
        $arr = json_decode($this->tags);
        if(!$arr){
            return '';
        }
        $tags = Tags::whereIn('id',$arr)->get();
        $return ='';
        foreach ($tags as $i) {
            $return .= '<span class="badge badge-default mx-1 my-1">'.$i->tag_name.'</span>';
        }
        // dd($return);
        return $return;
    }
    public function images(){
        if($this->images){
            return url($this->images);
        }else{
            return 'http://placehold.it/250x350';
        }
    }
    public function special(){
        return $this->hasMany(SpecialProduct::class);
    }
}
