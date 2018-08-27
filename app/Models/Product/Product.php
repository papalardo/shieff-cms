<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description', 
        'category_id'
    ];

    protected $hidden = [
      // 'category_id'
    ];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function price() {
        return $this->hasMany(Price::class, 'product_id', 'id');
    }

    public function feedstock() {
      return $this->hasMany(HasFeedstock::class, 'product_id', 'id');
    }

    public function side_dish() {
    	return $this->hasMany(HasSideDish::class, 'product_id', 'id');
    }

}
