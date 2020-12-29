<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];


    public function client()
    {
          return $this->hasone(Client::class,'id', 'client_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_order')->WithPivot('quantity');
    }
}
