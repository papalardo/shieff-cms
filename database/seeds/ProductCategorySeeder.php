<?php

use Illuminate\Database\Seeder;
use App\Models\Product\Category;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	   $categorys = [
     	   	'Hamburguers',
     	   	'Hot Dogs',
     	   	'Bebidas'
     	   ];

        foreach ($categorys as $key => $item) {
        	Category::create([
        		'description' => $item
        	]);
        }
    }
}
