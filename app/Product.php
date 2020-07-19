<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //to link with another table category_translate 
    //to add a data on category_translate table when add on category table
    use \Dimsav\Translatable\Translatable;
    protected $guarded=[];

    //to call it on view like users.index 
    //appends getImagePathAttribute() on down
    protected $appends=['image_path','profit_percent'];

    public $translatedAttributes = ['name','description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class,'product_order');
    }


    //that access image_path by getImagePathAttribute() builtIn
    //ana 3mlt al7rka de bld ma3od akrr url fil view
    public function getImagePathAttribute()
    {
        return asset('uploads/products_images/'.$this->image);
    }

    public function getProfitPercentAttribute()
    {
        $profit =$this->sale_price - $this->purchase_price;
        $profit_percent=$profit * 100 / $this->purchase_price;
        return number_format($profit_percent,2);
    }
}
