<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/detail', function () {
    return view('detail');
});

Route::get('/procesarRegistro', 'registerController@procesarRegistro');

Route::get('/procesarLogin', 'loginController@procesarLogin');


Route::get('/user', function () {
    return view('user');
});

Route::get('/gpu', function () {
    return view('gpu');
});

Route::get('/cpu', function () {
    return view('cpu');
});

Route::get('/ram', function () {
    return view('ram');
});

Route::get('/microondas', function () {
    return view('microondas');
});
Route::get('/lavadoras', function () {
    return view('lavadoras');
});
Route::get('/cafeteras', function () {
    return view('cafeteras');
});
Route::get('/android', function () {
    return view('android');
});
Route::get('/iphone', function () {
    return view('iphone');
});
Route::get('/accesorios', function () {
    return view('accesorios');
});

Route::get('/logout', 'loginController@logout');

Route::get('/deleteUser', function () {
    return view('deleteUser');
});

Route::get('/borrarPerfil', 'userController@borrarPerfil');

Route::get('/settings', function () {
    return view('settings');
});

Route::get('/reviews', function () {
    return view('reviews');
});

Route::get('/misPedidos', function () {
    return view('misPedidos');
});

Route::get('/procesarEditarUsuario', 'userController@procesarEditarUsuario');

Route::get('/procesarEditarImagenUsuario', 'userController@procesarEditarImagenUsuario');

Route::get('/deleteReview{id}', 'reviewsController@deleteReview');

/************************************** Product Controller *************************************/

Route::get('/añadirProducto', function () {
    return view('addProduct');
});

Route::get('/getProduct{nombre}', function ($nombre) {
    return view('gpu', ['getProduct'=>$nombre]);
});

Route::get('/editProductVista{id}', function ($id) {
    return view('editProduct', ['idProducto'=>$id]);
});

Route::get('/Eliminar', function () {
    return view('gpu');
});

Route::get('/displayRegisterInfo', function () {
    return view('displayRegisterInfo');
});

Route::get('/newProduct', 'productController@newProduct');
Route::get('/deleteProduct{id}','productController@deleteProduct');
Route::get('/editProduct{id}','productController@editProduct');
Route::get('/onClick{tipo}','productController@onClick');
Route::get('/goToDetail{id}','productController@goToDetail');

Route::get('/ordenarAscendente','productController@ordenarAscendente');
Route::get('/ordenarDescendente','productController@ordenarDescendente');


/************************************** WishList *************************************/
Route::get('/wishList', function () {
    return view('wishList');
});

Route::get('/procesarWishList{id}','wishListController@procesarWishList');
Route::get('/deleteWishListItem{id}','wishListController@deleteWishListItem');

/************************************** Carrito *************************************/

Route::get('/procesarCompra','productController@procesarCompra');
Route::get('/vaciarCarrito','productController@vaciarCarrito');
Route::get('/eliminarProduct','productController@eliminarProduct');

/************************************** Configurar PC *************************************/

Route::get('/buildYourPC', function () {
    return view('buildYourPC');
});
Route::get('/procesarCompraDos','productController@procesarCompraDos');
Route::get('/procesarBuild','productController@procesarBuild');
Route::get('/vaciarComponentes','productController@vaciarComponentes');
Route::get('/eliminarComponentes','productController@eliminarComponentes');
//Route::get('/addComponents','productController@addComponents');

/************************************** PayPal *************************************/
Route::get('/resultsPay', function () {
    return view('resultsPay');
});
Route::get('checkout','productController@checkout');
Route::get('/paypal/pay','paypalController@payWithPayPal');
Route::get('/paypal/status','paypalController@payPalStatus');

/************************************** Reviews *************************************/
Route::get('procesarReview{id}','reviewsController@procesarReview');
Route::get('modificarReview{id}','reviewsController@modificarReview');

/************************************** Footer *************************************/

Route::get('/avisoLegal', function () {
    return view('avisoLegal');
});
Route::get('/privacidad', function () {
    return view('privacidad');
});
Route::get('/politicaCookies', function () {
    return view('politicaCookies');
});

/************************************** AJAX *************************************/

Route::get('/ajaxUsers', 'productController@ajaxUsers');

Route::get('/ajaxProducts', 'productController@ajaxProducts');

/************************************** FREBASE *************************************/
Route::get('/getLocation{id}','FirebaseController@getLocation');

Route::get('/createChild{id}','FirebaseController@createChild');

/************************************** MAPA *************************************/
Route::get('/seguimiento', function () {
    return view('seguimiento');
});
