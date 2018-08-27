<?php

use Illuminate\Database\Seeder;
use App\Models\Product\Feedstock;
use App\Models\Product\HasFeedstock;

class ProductHasFeedstockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$all = Feedstock::all();

    	for($i=1; $i <= count($all); $i++) {
	       HasFeedstock::create([
	       	'product_id' => 1,
	       	'feedstock_id' => $i
	       ]);
       }
    }
}
