<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>

    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
        function openPage(pageName, elmnt, color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
</head>
<body id="cuerpo">

<?php

use App\Http\Controllers\productController;
use App\Http\Controllers\wishListController;

include "header.php";

$email = session('email');

$productAll = productController::getProducts();
//$wishListAll = wishListController::getWishListItems();
$wishListLogged = wishListController::getWishListItemsLogged();

$tipo = session('tipo');
$login = session('login');

if($login){

?>



<div class="barraIconos" id="iconUser">
    <a  class="iconUser" id="iconoPedidos" href="misPedidos">
        Mis pedidos
    </a>

    <a  class="iconUser" id="iconoPreferencias" href="settings">
        Preferencias
    </a>
    <a  class="iconUser" id="iconoPerfil"  href="user">
        Mi Perfil
    </a>
    <a  class="iconUser" id="iconoReviews" href="reviews">
        Reviews
    </a>
    <a  class="iconUser" id="iconoWishlist" style="background-color: #000" href="wishList">
        Mi Wishlist
        <span class="detalle_icono" ><?php echo count($wishListLogged) ?></span>
    </a>

    <a  class="iconUser" id=iconoLogout  href="logout">
        Logout
    </a>
</div>

<div class="contenedorMiCuenta">


    <section class="sectionTwo">
        <?php
        ?>
        <div class="rowProduct">
            <img class="imgHeart" src="img/heart.png" alt="heart">
            <h2 class="responsiveFont">Mi lista de deseos</h2>
        </div>

        <?php
        ?>
        <div class="row">
            <?php
            foreach ($wishListLogged as $wishlist) {
                foreach ($productAll as $producto) {
                    if ($wishlist->id_producto == $producto->id) {
                        ?>
                        <div class="column">
                            <div class="containerDos">
                                <div class="card">
                                    <img src="<?php echo "img/" . $producto->tipo . "/" . $producto->imagen . ".png" ?>"
                                         alt="imagen" style="width:100%">
                                    <div class="container">
                                        <h2 style="font-family: 'Comic Sans MS'"
                                            class="center"><?php echo $producto->nombre ?></h2>
                                        <div class="row">
                                            <?php
                                            if($producto->descuentoActivo){
                                                ?>
                                                <div class="column">
                                                    <h4 class="center"><?php echo $producto->precioConDescuento . "€" ?></h4>
                                                </div>
                                                <div class="column">
                                                    <h4 style="padding-left: 20px; color: red">
                                                        <strike><?php echo $producto->precio. "€" ?></strike></h4>
                                                </div>
                                                <?php
                                            }else{
                                                ?>
                                                <div class="column">
                                                    <h4 class="center"><?php echo $producto->precio . "€" ?></h4>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <div class="overlay">
                                                <div class="buttonHover">
                                                    <form name="formularioProducto" method="get" action="procesarCompra">
                                                        <input type="hidden" name="producto" value="<?php echo $producto->nombre ?>">
                                                        <input type="hidden" name="cantidad" value="1">
                                                        <input class="botonCard" type="submit" value="Añadir cesta"/>
                                                    </form>
                                                    <form name="productoDelete" action="<?php echo "deleteWishListItem".$wishlist->id ?>">
                                                        <input class="botonCard" type="submit" value="Borrar"/>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </section>

</div>

    <?php
} else{
    ?>

    <h1 style="text-align: center">No está logeado.</h1>

    <?php
}
?>



<?php include 'footer.php'; ?>

</body>
</html>
