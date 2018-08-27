<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products = \Cache::get($request->cart_id)['items'];

        $total = collect($products)->sum(function ($item) {
            return $item['subtotal'];
        });

        $order = Order::create([
            'method_pagament' => $request->pagament,
            'description' => $request->info,
            'cust_total' => $total,
        ]);

        foreach ($products as $key => $item) {
            $product = $order->products()->create([
                'product_id' => $item['product_id'],
                'qtd' => $item['qtd'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
            ]);

            foreach ($item['side_dish'] as $key => $sideDish) {
                $product->sideDish()->create([
                    'side_dish_id' => $sideDish['id']
                ]);
            }

            foreach ($item['feedstock_except'] as $key => $feedstock) {
                $product->feedstockException()->create([
                    'feedstock_id' => $feedstock['id']
                ]);
            }

            \Cache::forget($request->cart_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
