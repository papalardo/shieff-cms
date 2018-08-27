<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
	protected $table = 'product_price';

   protected $fillable = [
   	'description',
   	'price'
   ];
}
