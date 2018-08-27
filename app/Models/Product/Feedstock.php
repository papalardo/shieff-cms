<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Feedstock extends Model
{
    protected $table = 'product_feedstock';

    protected $fillable = [
    	'name',
    	'description'
    ];
}
