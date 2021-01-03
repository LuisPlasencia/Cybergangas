<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Añadir producto</title>

    <link rel="stylesheet" href="CSS/main.css">
    <script type="text/javascript" src="js/comprobarDatosProducto.js"></script>

</head>
<body>

<?php

use App\Http\Controllers\productController;

include 'header.php';
$canales = session('canales');
$usuarios = session('usuarios');

session(['idProducto'=>$idProducto]);

$productoAll = productController::getProducts();

?>


<h1 style="text-align: center" class="create">Editar Producto</h1>

<?php
    foreach ($productoAll as $product){
        if($product->id == $idProducto){
?>

<form class="formularioLogin" id="formularioAddProduct" method="get" action="<?php echo "editProduct".$idProducto?>">

    <div class="formularioDivProduct">

        <p><label>Nombre del producto</label> <input value="<?php echo $product->nombre ?>" class="productMod" type="text" size="15" name="nombreProducto" id="nombreProducto"></p>

        <p><label>Descripción</label> <input value="<?php echo $product->descripcion ?>" class="productMod" type="text" size="15" name="descripcion" id="descripcion"></p>

        <label>Nueva Imagen</label>
        <select class="productMod" name="imagen" id="imagen">
            <?php
            switch ($product->tipo) {
                case "gpu":
                    echo "<option value='rtx3070gigabyte'>rtx3070gigabyte</option>";
                    echo "<option value='rtx3070ventus'>rtx3070ventus</option>";
                    break;
                case "cpu":
                    echo "<option value='intel10700k'>intel10700k</option>";
                    break;
                case "ram":
                    echo "  <option value='ram_hyperx_fury_ddr4'>Kingston HyperX Fury Black DDR4</option>";
                    break;
                case "microondas":
                    echo "  <option value='microonda_samsung'>Microonda Samsung</option>";
                    break;
                case "lavadoras":
                    echo "  <option value='lavadora_samsung'>Lavadora Samsung</option>";
                    break;
                case "cafeteras":
                    echo "  <option value='cafetera_espresso'>Cafetera Espresso</option>";
                    break;
                case "android":
                    echo "  <option value='android_motorola'>Motorola smartphone</option>";
                    break;
                case "iphone":
                    echo "  <option value='iphone_12'>iPhone 12</option>";
                    break;
                case "accesorios":
                    echo "  <option value='funda_samsung'>Funda Samsung</option>";
                    break;
                default:
                    echo "Error";
            }
            ?>
        </select>

        <p><label>Precio</label> <input value="<?php echo $product->precio ?>" class="productMod" type="number" size="15" name="precio" min="0" id="precio"></p>

        <p><label>Descuento</label> <input value="<?php echo $product->precioConDescuento ?>" class="productMod" type="number" min="0" size="15" name="precioConDescuento" id="precioConDescuento"></p>

        <p><label>Stock</label> <input value="<?php echo $product->stock ?>" class="productMod" type="number" size="15" min="0" name="stock" id="stock"></p>

        <p><label>Descuento activo [0 ò 1]</label> <input value="<?php echo $product->descuentoActivo ?>" class="productMod" type="number" size="15" max="1" min="0" name="descuentoActivo" id="descuentoActivo"></p>

        <input class="loginButton" type="button" value="Editar" onclick="comprobarDatosProducto();">

    </div>

</form>

    <?php
    }
}
?>

<?php include 'footer.php';?>

</body>
</html>
