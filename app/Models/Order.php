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
            return "<span style='color:#2D9596'>WAIT FOR PAYMENT</span>";
        }else if($this->status == 2){
            return "<span style='color:#1640D6'>PAYMENT APPROVE</span>";
        }else{
            return "<span style='color:#FF8F8F'>PAYMENT REJECT</span>";
        }
    }
}
