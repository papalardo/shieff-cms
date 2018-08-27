<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Order\Order;

class OrderTransformer extends TransformerAbstract
{
     protected $defaultIncludes = ['products'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Order $order)
    {
        return [
            'method_pagament' => $order->method_pagament,
            // 'products' => $order->products
        ];
    }

    public function includeProducts(Order $order)
    {
        return $this->item($order->products, new ProductTransformer);
    }

}
