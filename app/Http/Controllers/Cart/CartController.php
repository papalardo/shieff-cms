<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Cache;
use Carbon\Carbon;

class CartController extends Controller
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
            $expiresAt = Carbon::now()->addMinutes(180);
            $cache_id = $request->cache_id;

            $id = $request->id;
            $feedstock = $request->feedstock;
            $sideDish = $request->sideDish;

            $product = Product::
            where(function($query) {
                return $query->with('price');
            }, $id)
            ->with(['price' => function($query) use ($id) {
                return $query->find($id);
            }])
            ->with(['side_dish' => function($query) use ($sideDish) {
                return $query->whereIn('side_dish_id', $sideDish);

            }])
            ->with(['feedstock' => function($query) use ($feedstock) {
                return $query->whereIn('feedstock_id', $feedstock);
            }])
            ->first()->toArray();

            $product['price'] = $product['price'][0];

            $payLoad = [
                'product_id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price']['price'],
                'qtd' => 1,
                'description' => $product['price']['description'],
                'side_dish' => $product['side_dish'],
                'feedstock_except' => $product['feedstock'],
                'created_at' => Carbon::now(),
                'subtotal' => $product['price']['price'],
            ];

            if(Cache::get($cache_id) === null) {
                $side_dish_total = collect($product['side_dish'])->sum(function($item) {
                    return $item['price'];
                });

                $total = $payLoad['subtotal'] = $side_dish_total + $product['price']['price'];
                Cache::put($cache_id,  ['items' => [str_random(20) => $payLoad], 'total' => $total, 'count' => 1], $expiresAt);
            } else {
                $products = Cache::get($cache_id);
                $find = false;
                $products = $products['items'];
                foreach ($products as $key => $value) {

                        $diff_array = array_diff(array_map('json_encode', $products[$key]), array_map('json_encode', $payLoad));
                        $diff_array2 = array_diff(array_map('json_encode', $payLoad), array_map('json_encode', $products[$key]));

                        unset($diff_array['qtd']);
                        unset($diff_array['subtotal']);
                        unset($diff_array['created_at']);

                        unset($diff_array2['qtd']);
                        unset($diff_array2['subtotal']);
                        unset($diff_array2['created_at']);

                        if(empty($diff_array) && empty($diff_array2)) {
                            $find = $key;
                            break;
                    }
                }


                if($find === false) {
                    $products = array_add($products, str_random(20), $payLoad);
                } else {
                    $products[$find]['qtd']++;
                }

                $total = 0;
                $count = 0;
                foreach ($products as $key => $value) {
                    $side_dish_subtotal = collect($value['side_dish'])->sum(function($item) {
                        return $item['price'];
                    });

                    $count = $count + $products[$key]['qtd'];
                    $subtotal = ($side_dish_subtotal + $products[$key]['price']) * $products[$key]['qtd'];
                    $products[$key]['subtotal'] = $subtotal;
                    $total = $total + $subtotal;
                }

                Cache::put($cache_id, ['items' => $products, 'total' => $total, 'count' => $count], $expiresAt);
            }
            return response()->json(Cache::get($cache_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Cache::get($id) === null ) return response()->json(['items' => [], 'count' => 0, 'total' => 0], 200);
        return response()->json(Cache::get($id), 200);
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
    public function destroy(Request $request, $id)
    {
        $products = Cache::get($request->cart);
        $products = $products['items'];
        $expiresAt = Carbon::now()->addMinutes(30);

        unset($products[$id]);
        // if($products[$id]['qtd'] <= 1) {
        //     unset($products[$id]);
        // } else {
        //     $products[$id]['qtd']--;
        // }

        $total = 0;
        $count = 0;
        foreach ($products as $key => $value) {
            $side_dish_subtotal = collect($value['side_dish'])->sum(function($item) {
                return $item['price'];
            });

            $count = $count + $products[$key]['qtd'];
            $subtotal = ($side_dish_subtotal + $products[$key]['price']) * $products[$key]['qtd'];
            $products[$key]['subtotal'] = $subtotal;
            $total = $total + $subtotal;
        }

        Cache::put($request->cart, ['items' => $products, 'total' => $total, 'count' => $count], $expiresAt);
        return response()->json(Cache::get($request->cart), 200);

    }
}
