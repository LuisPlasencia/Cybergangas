<?php

namespace App\Http\Controllers;

use App\Facturas;
use App\Http\Controllers\Controller;
use App\Ordenes;
use App\OrdenesDetalle;
use App\Productos;
use App\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\FirebaseController;

class productController extends Controller
{
    public static function getProducts(){
        return Productos::all();
    }
    public static function getProductsReverse(){
        return Productos::all()->reverse();
    }

    public static function getNumberOfProducts(){
        return Productos::all()->count();
    }

    public static function getNumberOfThatProduct($tipo){
        return Productos::where("tipo",$tipo)->count();
    }

    public function newProduct(){

        if(isset($_GET["tipo"],$_GET["nombreProducto"],$_GET["descripcion"],$_GET["precio"],
            $_GET['imagen'],$_GET["precioConDescuento"], $_GET['stock'], $_GET['stock'])) {

            $tipo = $_GET["tipo"];
            $nombreProducto = $_GET["nombreProducto"];
            $descripcion = $_GET["descripcion"];
            $precio = $_GET["precio"];
            $imagen = $_GET["imagen"];
            $precioConDescuento = $_GET["precioConDescuento"];
            $stock = $_GET["stock"];
            $descuentoActivo = $_GET["descuentoActivo"];;

            // Comprobando que el producto ya existe antes de crear otro nuevo
            $productosAll = self::getProducts();
            foreach($productosAll as $product){
                if($product->nombre == $nombreProducto ){
                    return "<h3>El producto ya existe!</h3>";
                }
            }

            $product = new Productos();
            $product->tipo = $tipo;
            $product->nombre = $nombreProducto;
            $product->descripcion = $descripcion;
            $product->precio = $precio;
            $product->imagen = $imagen;
            $product->precioConDescuento = $precioConDescuento;
            $product->descuentoActivo = $descuentoActivo;
            $product->stock = $stock;
            $product->save();

            return redirect('/');

        } else {

            return "<h3>Rellene todos los campos </h3>";
        }

    }

    public function editProduct($id){

        $product = Productos::where('id', $id)->first();
        $tipo = $product->tipo;


        if(isset($_GET["nombreProducto"],$_GET["descripcion"],$_GET["precio"],
            $_GET['imagen'],$_GET["precioConDescuento"],$_GET["descuentoActivo"],$_GET["stock"])) {


            $nombreProducto = $_GET["nombreProducto"];
            $descripcion = $_GET["descripcion"];
            $precio = $_GET["precio"];
            $imagen = $_GET["imagen"];
            $precioConDescuento = $_GET["precioConDescuento"];
            $descuentoActivo = $_GET["descuentoActivo"];
            $stock = $_GET["stock"];


            // Comprobando que el producto existe, solo el que tenga ese id puede dejar el mismo nombre
            $productosAll = self::getProducts();
            foreach($productosAll as $product){
                if($product->id != $id){
                    if($product->nombre == $nombreProducto ){
                        return "<h3>El producto ya existe!</h3>";
                    }
                }
            }

            $product->nombre = $nombreProducto;
            $product->descripcion = $descripcion;
            $product->precio = $precio;
            $product->imagen = $imagen;
            $product->stock = $stock;
            $product->precioConDescuento = $precioConDescuento;
            $product->descuentoActivo = $descuentoActivo;
            $product->save();

        }

        return redirect()->to($tipo);
    }

    public function deleteProduct($id){
        $ordenesDetalle = OrdenesDetalle::where('id_producto', $id)->get();
        if($ordenesDetalle != '[]' ){
            return "<h3>Existen ordenes detalle con dicho producto. Contacte en administración para su borrado.</h3>";
        }
        Productos::where('id', $id)->delete();
        return redirect()->back();
    }

    public function onClick($tipo){
        session(["tipo"=>$tipo]);
        return redirect()->to("producto");
    }

    public function goToDetail($id){
        session(["productoId"=>$id]);
        return redirect()->to("detail");

    }

    public function procesarCompra(){

        if (isset($_GET['producto'], $_GET['cantidad'])){
            $producto = $_GET['producto'];
            $cantidad = $_GET['cantidad'];

            if(session()->has($producto)){ //si ya existe... añadimos los que estaban
                $cantidadAntes = session($producto); //index
                $cantidadActual = $cantidadAntes + $cantidad;
                session([$producto=>$cantidadActual]);
            } else {
                session([$producto => $cantidad]);
            }
        }

        return redirect()->back();

    }

    public function vaciarCarrito(){
        $productosAll = self::getProducts();
        foreach($productosAll as $producto){
            if(session()->has($producto->nombre)){
                session()->forget($producto->nombre);
            }
        }
        return redirect()->back();
    }

    public static function vaciarCarritoDespuesDeCompra(){
        $productosAll = self::getProducts();
        foreach($productosAll as $producto){
            if(session()->has($producto->nombre)){
                session()->forget($producto->nombre);
            }
        }
        session()->forget('vaciarCarritoDespuesDeCompra');
    }


    public function eliminarProduct(){

        if (isset($_GET['producto'])){
            $producto = $_GET['producto'];
            if(isset($_GET['Eliminar'])){
                session()->forget($producto);
            }
        }

        return redirect()->back();
    }

    /***** PC BUILD ******/

    public function procesarBuild(){

        if (isset($_GET['componente'], $_GET['cantidadComponente'])){
            $componente = $_GET['componente'];
            $cantidadComponente = $_GET['cantidadComponente'];
            if(session()->has($componente)){ //si ya existe... añadimos los que estaban
                $cantidadAntes = session($componente); //index
                $cantidadActual = $cantidadAntes + $cantidadComponente;
                session([$componente=>$cantidadActual]);
            } else {
                session([$componente=> $cantidadComponente]);
            }
        }

        return redirect()->to("buildYourPC");

    }

    public function vaciarComponentes(){
        $productosAll = self::getProducts();
        foreach($productosAll as $producto){
            if(session()->has($producto->nombre."Dos")){
                session()->forget($producto->nombre."Dos");
            }
        }

        return redirect()->to("buildYourPC");
    }

    public function eliminarComponentes(){
        if (isset($_GET['componente'])){
            $componente = $_GET['componente'];
            if(isset($_GET['EliminarComponente'])){
                session()->forget($componente);
            }
        }

        return redirect()->to('buildYourPC');
    }

    /****** PayPal ********/

    public function checkout(){

        if(isset($_GET['cantidadFinal'])){

            $cantidadFinal = $_GET['cantidadFinal'];
            session(['cantidadFinal'=>$cantidadFinal]);
            // Order
            $order = new Ordenes();
            $order->id_usuario = session('user');
            $order->total = $cantidadFinal;
            $order->estado = "Pendiente de stock";
            $order->save();
            session(['orderID'=>$order->id]);


            // Order Detail
            $productosAll = self::getProducts();
            foreach($productosAll as $producto){
                if(session()->has($producto->nombre)){
                    $orderDetail = new OrdenesDetalle();
                    $orderDetail->id_orden = $order->id;
                    $orderDetail->id_producto = $producto->id;
                    $orderDetail->cantidad = session($producto->nombre);
                    $orderDetail->save();

                    //Decrementamos el stock
                    $nuevoStock = $producto->stock - session($producto->nombre);
                    if($nuevoStock < 0){
                        return  "<h3>Un producto se ha quedado sin stock. Operación Cancelada.";
                    }
                    $modStockProducto = Productos::where('id', $producto->id)->update(array('stock' => $nuevoStock));


                }
            }

            //Ahora la orden la podemos dar por satisfecha ya que ha habido suficiente stock
            $modOrden = Ordenes::where('id', $order->id)->update(array('estado' => 'Pendiente de pago'));

            //CREAMOS ORDEN EN FIREBASE
            FirebaseController::createChild($order->id);


            //Factura
            $factura = new Facturas();
            $factura->id_orden = $order->id;
            $factura->id_usuario = session('user');
            $factura->estado = "Pending";
            $factura->moneda = "Euros";
            $factura->total = $cantidadFinal;
            $factura->formaDePago = "PayPal";
            $factura->save();
            session(['invoiceID'=>$factura->id]);
        }

        return redirect()->to("/paypal/pay");
    }

    /********** AJAX *************/

    // Funcionalidad AJAX número de usuarios registrados
    public function ajaxUsers(){
        $user = Usuario::all();
        $numberOfUser = count($user);
        return $numberOfUser;
    }

    // Funcionalidad AJAX número de usuarios registrados
    public function ajaxProducts(){
        $productos = Productos::all();
        $numberOfProducts = count($productos);
        return $numberOfProducts;
    }

    public function ordenarAscendente(){
        session(['ascendente' => true]);

        return redirect()->back();
    }

    public function ordenarDescendente(){
        session(['descendente' => true]);

        return redirect()->back();
    }


}
