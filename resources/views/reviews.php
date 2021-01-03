<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>

    <link rel="stylesheet" href="CSS/main.css">
    <script type="text/javascript" src="js/comprobarEditarUsuario.js"></script>

</head>
<body id="cuerpo">

<?php include 'header.php';

use App\Http\Controllers\wishListController;
use App\Http\Controllers\reviewsController;
use App\Http\Controllers\productController;

$login = session('login');
$username = session('name');
$email = session('login');
$avatar = session('avatar');
$fecha = session('fecha');
$avatar = session('avatar');
$id = session('user');


$reviews = reviewsController::getReviewsFromLogged();
$wishListLogged = wishListController::getWishListItemsLogged();
$productAll = productController::getProducts();


if($login){
    ?>


    <div class="barraIconos" id="iconUser">
        <a  class="iconUser" id="iconoPedidos" href="misPedidos">
            Mis pedidos
        </a>

        <a  class="iconUser" id="iconoPreferencias"  href="settings">
            Preferencias
        </a>
        <a  class="iconUser" id="iconoPerfil" href="user">
            Mi Perfil
        </a>
        <a  class="iconUser" id="iconoReviews" style="background-color: #000"  href="reviews">
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

        if(count($reviews) == 0){
            ?>
            <div class="reviewContenedor">
                <p class = review_informacion>Actualmente no tienes ninguna review</p>

            </div>

        <?php
        } else{
            foreach ($reviews as $review){
        ?>

            <div class="reviewContenedor">
                <a class="iconosPerfil" href= "deleteReview<?php echo $review->id ?>" > <img src="img/papelera.png"></a>
                <p class = review_informacion >Producto: <?php
                    foreach ($productAll as $producto) {
                        if ($producto->id == $review->id_producto) {
                            echo $producto->nombre;
                            $productoActual = $producto;
                            break;
                        }
                    }
                ?>
                </p>
                <p class = review_informacion >Puntuación: <?php

                            echo $review->puntuacion." estrellas";

                    ?>
                </p>
                <p class = review_text ><?php echo $review->review ?> </p>
                <img src="<?php echo "img/".$productoActual->tipo."/".$productoActual->imagen.".png" ?>" alt="imagen" class="imagenReview" ">
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
