<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Intervention\Image\Facades\Image;
use Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
  
    public function index(Request $request)
    {
        $categories=Category::all();

        $products=Product::when($request->search,function($q) use($request){

            return $q->whereTranslationLike('name','%'.$request->search.'%');

        })->when($request->category_id,function($q) use($request){

            return $q->where('category_id',$request->category_id);

        })->latest()->paginate(5);

        return view('dashboard.products.index',compact('products','categories'));
    }


    public function create()
    {
        $categories=Category::all();
        return view('dashboard.products.create',compact('categories'));
    }


    public function store(Request $request)
    {
        
        $rules=[
            'category_id'=>'required',
        ];
        //loop to get two languages AR / EN
        foreach (config('translatable.locales') as $locale) {
            
            $rules +=[$locale.'.name'=>'required|unique:product_translations,name'];
            $rules +=[$locale.'.description'=>'required'];
        }
        $rules +=['purchase_price'=>'required',
                'sale_price'=>'required',    
                'stock'=>'required',    
                
         ];

         $request->validate($rules);

        $request_data=$request->all();    
        if($request->image)
        {
            // create instance
            Image::make($request->image)
                  ->resize(300, null, function ($constraint) {   // resize the image to a width of 300 and constrain aspect ratio (auto height)
                    $constraint->aspectRatio();
                   })->save(public_path('uploads/products_images/'.$request->image->hashName()));
            //ready to store image of name after hashName()
            $request_data['image']=$request->image->hashName();
        }
        $product=Product::create($request_data);
        
        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.products.index');
    }

    public function show(Product $product)
    {
        //
    }

  
    public function edit(Product $product)
    {
        $categories=Category::all();
        return view('dashboard.products.edit', compact('product','categories'));
    }

 
    public function update(Request $request, Product $product)
    {
        $rules=[
            'category_id'=>'required',
        ];
        //loop to get two languages AR / EN
        foreach (config('translatable.locales') as $locale) {
            
            $rules +=[$locale.'.name'=>['required',Rule::unique('product_translations','name')->ignore($product->id,'product_id')]];
            $rules +=[$locale.'.description'=>'required'];
        }
        $rules +=['purchase_price'=>'required',
                'sale_price'=>'required',    
                'stock'=>'required',    
                
         ];

         $request->validate($rules);

        $request_data=$request->all();    
        if($request->image)
        {
            if($product->image != 'default.png')
            {
                  //delete old real image 
                  Storage::disk('public_uploads')->delete('/products_images/'.$product->image);
         
            }
           // create instance
           Image::make($request->image)
                     ->resize(300, null, function ($constraint) {   // resize the image to a width of 300 and constrain aspect ratio (auto height)
                        $constraint->aspectRatio();
                     })->save(public_path('uploads/products_images/'.$request->image->hashName()));

           //ready to store image of name after hashName()
           $request_data['image']=$request->image->hashName();
          
        }
        $product->update($request_data);
        
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.products.index');
    }


    public function destroy(Product $product )
    {
        //before delete , check this
        if($product->image != 'default.png')
        {
              //delete old real image 
              Storage::disk('public_uploads')->delete('/products_images/'.$product->image);
     
        }
        $product->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');
    }
}
