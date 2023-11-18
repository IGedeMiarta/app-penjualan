<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function customer(){
        return $this->belongsTo(User::class,'customer');
    }
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function status(){
        if($this->status == 1){
            return "WAIT FOR PAYMENT";
        }else if($this->status == 2){
            return "PAYMENT APPROVE";
        }else{
            return "PAYMENT REJECTED";
        }
    }
}
