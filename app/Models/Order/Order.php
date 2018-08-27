<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'method_pagament',
        'description',
        'cust_total'
    ];

    public function products()
    {
        return $this->hasMany(HasProduct::class, 'order_id', 'id');
    }
}
