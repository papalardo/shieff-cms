<?php

use Illuminate\Database\Seeder;
use App\Models\Product\Product;
use App\Models\Product\Price;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	$product = Product::create([
        		'name' => 'X-Tudo',
        		'category_id' => 1
        	]);
    	
    	Price::create([
    		'product_id' => $product->id,
    		'price' => 5.0
    	]);
    }
}
