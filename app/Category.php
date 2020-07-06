<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Category extends Model
{
    //to link with another table category_translate 
    //to add a data on category_translate table when add on category table
    use \Dimsav\Translatable\Translatable;

    //protected $fillable=['name'] ;
    protected $guarded=[];

    public $translatedAttributes = ['name'];
   
}
