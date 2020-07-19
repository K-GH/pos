<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products=['product one', 'product two','product three', 'product four'];

        foreach ($products as $product) {
            
            Product::create([
                'category_id'=>1,
                'purchase_price'=>75.66,
                'sale_price'=>91,
                'stock'=>50,
                'ar'=>['name'=> $product ,'description'=>$product],
                'en'=>['name'=> $product ,'description'=>$product],
            ]);
        }
    }
}
