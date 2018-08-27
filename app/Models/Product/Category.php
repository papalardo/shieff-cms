<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'product_category';
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description'
    ];
}
