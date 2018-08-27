<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\ProductTransformer;
use App\Models\Product\Product;

class ProductController extends Controller
{
    protected $model;

    function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->model
        ->with(['category', 'price', 'feedstock.feedstock', 'side_dish.side_dish'])
        ->get()->toArray();

        foreach ($products as $key => $product) {

            foreach ($product['feedstock'] as $key2 => $item) {
                $products[$key]['feedstock'][$key2] = $item['feedstock'];
            }

            foreach ($product['side_dish'] as $key2 => $item) {
                $products[$key]['side_dish'][$key2] = $item['side_dish'];
            }
        }

        return $products;

        // return fractal($this->model->all(), new ProductTransformer())->respond();
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
        return $this->model->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return fractal(Product::find($id), new ProductTransformer())->respond();
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
        $product = $this->model->findOrFail($id);
        $product->fill($request->all());
        $product->save();
        return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->model->findOrFail($id);
        $product->delete();
        return 'ok';
    }
}
