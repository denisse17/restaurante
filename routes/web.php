<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::bind('producto', function($ficha){
    return App\Producto::where('ficha', $ficha)->first();
});

Route::get('/',[
    'as'=>'home',
    'uses'=>'RestaurantController@index']);

Route::get('/producto/{ficha}', [
    'as'=>'detalle-producto',
    'uses'=> 'RestaurantController@verDetalles'
]);
Route::get('/categorias', 'TiendaController@index')->name('tienda.index');

//cesta-------------------
Route::get('/cart/mostrar', [
    'as'=>'cart',
    'uses'=> 'CestaController@mostrar'
]);

Route::get('cart/agregar/{producto}',[
    'as'=>'cart-agregar',
    'uses'=> 'CestaController@agregar'
]);

Route::get('cart/eliminar/{producto}',[
    'as'=>'cart-eliminar',
    'uses'=> 'CestaController@eliminar'
]);

Route::get('cart/eliminartodos',[
    'as'=>'cart-eliminar-todos',
    'uses'=> 'CestaController@eliminartodos'
]);

Route::get('cart/actualizar/{producto}/{cantidad?}',[
    'as'=>'cart-actualizar',
    'uses'=> 'CestaController@actualizar'
]);


//Route::get('/categorias/{producto}', 'TiendaController@mostrar')->name('tienda.show');

//Route::get('/lista-productos/{categoria}', 'TiendaController@listar')->name('tienda.listar');

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

//Auth::logout();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('detalle-pedido',[
    'middleware'=> 'auth',
        'as'=> 'detalle-pedido',
    'uses'=>'CestaController@detallePedido'
]);

//Paypal

Route::get('pago', array(
    'as'=>'pago',
    'uses'=> 'PaypalController@postPago',
));
Route::get('pago/status', array(
    'as'=>'pago.status',
    'uses'=> 'PaypalController@getPagoStatus',
));