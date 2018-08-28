<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('model', function() {
    return \App\Models\Product\Product::with(['category', 'price', 'feedstock', 'side_dish'])->get();
});

Route::get('close/{session}', function ($session) {

    $products = \Cache::get($session)['items'];

    $total = collect($products)->sum(function ($item) {
        return $item['subtotal'];
    });

    $order = App\Models\Order\Order::create([
        'method_pagament' => 'Dinheiro',
        'description' => 'Buzinar quando chegar',
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
    }
});

Route::get('view/{id?}', function ($id = '') {

    $products = App\Models\Order\Order::where('id', $id)->with(['products.product','products.sideDish.sideDish', 'products.feedstockException.feedstock'])->get();
    return $products;
});

Route::middleware(['api'])->resource('cart', 'Cart\CartController');
Route::middleware(['api'])->resource('order', 'Order\OrderController');
Route::middleware(['api'])->resource('user', 'Site\User\UserController');

Route::group([ 'namespace' => 'Auth', 'prefix' => 'auth', 'middleware' => ['api', 'cors'] ],
    function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('oauth/login', 'SocialiteController@login');
        Route::get('login/{provider}', 'SocialiteController@redirect');
        Route::get('login/{provider}/callback', 'SocialiteController@callback');

        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::get('refresh', 'AuthController@refresh');
        Route::get('user', 'AuthController@user');
});

Route::group([
    'middleware' => ['api', 'cors']
], function ($router) {
    Route::get('products', 'ProductController@index');
    Route::get('users', 'UserController@getUsers');
    Route::get('articles', 'ArticleController@getArticles');
});
