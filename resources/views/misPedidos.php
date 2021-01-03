<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>

    <link rel="stylesheet" href="CSS/main.css">
    <script type="text/javascript" src="js/comprobarEditarUsuario.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            $("#pedidoContenedor1").click(function(){
                $("#detalleMisPedidos1").slideDown("slow");
            });


            $("#pedidoContenedor2").click(function(){
                $("#detalleMisPedidos2").slideDown("slow");
            });

            $("#pedidoContenedor3").click(function(){
                $("#detalleMisPedidos3").slideDown("slow");
            });

            $("#pedidoContenedor4").click(function(){
                $("#detalleMisPedidos4").slideDown("slow");
            });

            $("#pedidoContenedor5").click(function(){
                $("#detalleMisPedidos5").slideDown("slow");
            });

            $("#pedidoContenedor6").click(function(){
                $("#detalleMisPedidos6").slideDown("slow");
            });

            $("#pedidoContenedor7").click(function(){
                $("#detalleMisPedidos7").slideDown("slow");
            });

            $("#pedidoContenedor8").click(function(){
                $("#detalleMisPedidos8").slideDown("slow");
            });

            $("#pedidoContenedor9").click(function(){
                $("#detalleMisPedidos9").slideDown("slow");
            });

            $("#pedidoContenedor10").click(function(){
                $("#detalleMisPedidos10").slideDown("slow");
            });

        });
    </script>

</head>
<body id="cuerpo">
<body id="cuerpo">

<?php include 'header.php';

use App\Http\Controllers\pedidosController;
use App\Http\Controllers\productController;
use App\Http\Controllers\wishListController;

$login = session('login');

$wishListLogged = wishListController::getWishListItemsLogged();
$ordenes = pedidosController::getOrdenesLogged();
$productAll = productController::getProducts();


if($login){
    ?>


    <div class="barraIconos" id="iconUser">
        <a  class="iconUser" id="iconoPedidos"  style="background-color: #000" href="misPedidos">
            Mis pedidos
        </a>

        <a  class="iconUser" id="iconoPreferencias"  href="settings">
            Preferencias
        </a>
        <a  class="iconUser" id="iconoPerfil" href="user">
            Mi Perfil
        </a>
        <a  class="iconUser" id="iconoReviews"  href="reviews">
            Reviews
        </a>
        <a  class="iconUser" id="iconoWishlist" href="wishList">
            Mi Wishlist
            <span class="detalle_icono" ><?php echo count($wishListLogged) ?></span>
        </a>

        <a  class="iconUser" id=iconoLogout  href="logout">
            Logout
        </a>
    </div>


    <div class="contenedorMiCuenta" style="text-align: center;">

        <?php

        if(count($ordenes) == 0){
        ?>
            <div class="pedidoContenedor">
                <p class = pedidoInformacion>Aún no has realizado ningún pedido</p>

            </div>

            <?php
        } else{
            $contador = 1;
            foreach ($ordenes as $orden){
            ?>

                <div class="pedidoContenedor"  id="pedidoContenedor<?php echo $contador;  ?>">

                    <p class="pedidoInformacion"  >Fecha: <?php echo $orden->created_at ?></p>
                    <p class = pedidoInformacion >Total: <?php echo $orden->total ?>€</p>
                    <?php
                        if($orden->estado == "Enviado"){
                    ?>
                        <a class="boton_seguimiento" href="getLocation<?php echo $orden->id; ?>" >Seguimiento</a>
                    <?php
                        }
                    ?>

                    <p class = pedidoInformacion >Estado: <?php echo $orden->estado ?></p>

                    <div class="detalleMisPedidos" id="detalleMisPedidos<?php echo $contador; $contador = $contador+1 ?>">




                    <?php
                    $ordenesDetalle = pedidosController::getOrdenesDetalle($orden->id);
                    foreach($ordenesDetalle as $ordenDetalle){
                    ?>
                        <?php
                        foreach($productAll as $producto){
                            if($producto->id == $ordenDetalle->id_producto){
                         ?>
                                <div class="separacionOrdenesDetalle"></div>
                                <p class = pedidoTexto >Producto: <?php echo $producto->nombre ?> </p>
                                <p class = pedidoTexto >Tipo: <?php echo $producto->tipo ?> </p>
                                <p class = pedidoTexto >Cantidad: x<?php echo $ordenDetalle->cantidad ?> </p>

                                <?php
                                if($producto->descuentoActivo == 1){
                                ?>
                                    <p class = pedidoTexto >Precio unidad: <?php echo $producto->precioConDescuento ?> </p>
                                <?php
                                }else{
                                ?>
                                    <p class = pedidoTexto >Precio unidad: <?php echo $producto->precio ?>€ </p>
                                <?php
                                }
                                ?>
                                <img src="<?php echo "img/".$producto->tipo."/".$producto->imagen.".png" ?>" alt="imagen" class="imagenPedido" >
                        <?php
                                break;
                            }
                        }
                        ?>


                  <?php
                    }
                    ?>

                    </div>
                </div>

        <?php
            }
        }
        ?>
    </div>

    <?php
    } else{
    ?>
    <h1 style="text-align: center">No está logeado.</h1>

    <?php
    }
?>



<?php include 'footer.php';?>

</body>
</html>
