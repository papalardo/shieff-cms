<?php

use Illuminate\Database\Seeder;
use App\Models\Product\SideDish;

class SideDishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $side_dish = [
       		'Carne de hamburger',
       		'Salsicha',
       		'Tomate'
       ];

       foreach ($side_dish as $key => $item) {
       	SideDish::create([
       		'name' => $item,
       		'price' => 2.0
       	]);
       }
    }
}
