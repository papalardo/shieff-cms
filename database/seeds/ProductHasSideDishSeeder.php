<?php

use Illuminate\Database\Seeder;
use App\Models\Product\HasSideDish;
use App\Models\Product\SideDish;

class ProductHasSideDishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $all = SideDish::all();

    	for($i=1; $i <= count($all); $i++) {
	       HasSideDish::create([
	       	'product_id' => 1,
	       	'side_dish_id' => $i
	       ]);
       }
    }
}
