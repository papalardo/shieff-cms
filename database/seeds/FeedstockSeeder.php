<?php

use Illuminate\Database\Seeder;
use App\Models\Product\Feedstock;

class FeedstockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $feedstocks = [
       		'Carne de 200g',
       		'Alface',
       		'Tomate',
       		'Bacon', 
       		'Queijo'
       ];

       foreach ($feedstocks as $key => $item) {
       	Feedstock::create([
       		'name' => $item
       	]);
       }
    }
}
