<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];


    public function client()
    {
          return $this->belognsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_order');
    }
}
