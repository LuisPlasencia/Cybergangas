<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="CSS/main.css">

    <!--    PARA las estrellitas de opiniones-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script language="JavaScript"  src = "js/comprobarReview.js"></script>

</head>
<body>

<?php use App\Http\Controllers\productController;
use App\Http\Controllers\reviewsController;
use App\Http\Controllers\userController;
use App\Http\Controllers\pedidosController;

include 'header.php';
$productosAll = productController::getProducts();
$reviewsAll = reviewsController::getReviews();
$usersAll = userController::getUsers();
$ordenes = pedidosController::getOrdenesLogged();

$productoId = session("productoId");
if($productoId != null){

$username = session('name');
$idUsuario = session('user');

if (session()->has('popupDos')) {
    echo '<script type="text/javascript">alert("Ya tenías dicho producto en la wishList!")</script>';
}

if (session()->has('popupTres')) {
    echo '<script type="text/javascript">alert("Se ha añadido correctamente en tu lista de deseos")</script>';
}


$media = 0;
$puntuacionesTotales = 0;
$numeroReviews = 0;
$estrella1 = 0;
$estrella2 = 0;
$estrella3 = 0;
$estrella4 = 0;
$estrella5 = 0;
foreach ($reviewsAll as $review) {
    if ($review->id_producto == $productoId) {
        $puntuacionesTotales = $puntuacionesTotales + $review->puntuacion;
        $numeroReviews = $numeroReviews + 1;
        if ($review->puntuacion == 1) {
            $estrella1 = $estrella1 + 1;
        } else if ($review->puntuacion == 2) {
            $estrella2 = $estrella2 + 1;
        } else if ($review->puntuacion == 3) {
            $estrella3 = $estrella3 + 1;
        } else if ($review->puntuacion == 4) {
            $estrella4 = $estrella4 + 1;
        } else if ($review->puntuacion == 5) {
            $estrella5 = $estrella5 + 1;
        }
    }
}
if($numeroReviews != 0){
    $media = $puntuacionesTotales / $numeroReviews;
} else{
    $media = 0;
}



?>


<div style="margin-bottom: 5%">
    <?php
    foreach ($productosAll as $producto) {
        if ($producto->id == $productoId) {
            $productoActual = $producto;
            ?>
            <div class="cardDetail">
                <img src="<?php echo "img/" . $producto->tipo . "/" . $producto->imagen . ".png" ?>" alt="imagen"
                     style="width:100%">

            </div>
            <?php
        }
    }
    ?>
</div>

<div style="margin-bottom: 10%">
    <?php
    foreach ($productosAll as $producto) {
        if ($producto->id == $productoId) {
            ?>
            <div style="margin-top: 5%">
                <p class="responsiveFont"><?php echo $producto->nombre ?></p>
                <?php
                if($producto->descuentoActivo){
                    ?>

                    <p class="responsiveFont"><?php echo "Precio: ".$producto->precioConDescuento . "€" . " <b>(Ahorra " . intval($producto->precioConDescuento*100/$producto->precio) . "%)</b>" ?></p>
                    <p class="responsiveFont">ANTES: <strike style="color: red"><?php echo $producto->precio . "€" ?></strike></p>


                <?php
                }else{
                    ?>

                    <p class="responsiveFont"><?php echo "Precio: ".$producto->precio . "€" ?></p>

                <?php
                }
                ?>


                <span class="fa fa-star <?php if($media > 0.5){ echo "checked"; }  ?>"></span>
                <span class="fa fa-star <?php if($media > 1.5){ echo "checked"; }  ?>"></span>
                <span class="fa fa-star <?php if($media > 2.5){ echo "checked"; }  ?>"></span>
                <span class="fa fa-star <?php if($media > 3.5){ echo "checked"; }  ?>"></span>
                <span class="fa fa-star <?php if($media > 4.5){ echo "checked"; }  ?>"></span>
                <p class="responsiveFont">Vendido y enviado por <b>Cybergangas</b></p>
                <p class="responsiveFont">Envío: Desde 5€</p>
                <p class="responsiveFont">Promoción: Compra ahora y llevate un 10% de descuento</p>
                <?php
                if($producto->stock>100){
                ?>
                <p class="responsiveFont">Disponibilidad: ¡En Stock!</p>
                <?php
                } else if($producto->stock<50 && $producto->stock>10){
                ?>
                <p class="responsiveFont">Disponibilidad: ¡¡Quedan pocas unidades!!</p>
                <?php
                } else if($producto->stock<10 && $producto->stock>1){
                ?>
                <p class="responsiveFont">Disponibilidad: ¡¡¡Date prisa antes de que se terminen!!!</p>
                <?php
                } else {
                ?>
                <p class="responsiveFont">Disponibilidad: Sin stock</p>
                <?php
                }
        }
    }
                ?>

                <div class="rowProductDetail">
                    <input onclick="location.href = '<?php echo "procesarWishList" . $productoActual->id ?>'" class="heartButton"
                           type="image" src="img/heart.png"/>
                    <form name="formularioProducto" method="get" action="procesarCompra">
                        <input type="hidden" name="producto" value="<?php echo $productoActual->nombre?>">

                        <input class="addCarrito"  type="submit" value="Añadir cesta"/>
                        Cantidad: <select name="cantidad">
                            <option>
                                1
                            </option>

                            <option>
                                2
                            </option>

                            <option>
                                3
                            </option>

                            <option>
                                4
                            </option>

                        </select>
                    </form>
                </div>
            </div>
        </div>


</div>

<hr class="hrDos">

<section>
    <button class="tablink" onclick="openPage('Caracteristicas', this, 'red')">Descripción</button>
    <button class="tablink" onclick="openPage('Especificaciones', this, 'green')" id="defaultOpen">Disponibilidad
    </button>
    <button class="tablink" onclick="openPage('Opiniones', this, 'blue')">Puntuaciones</button>
    <button class="tablink" onclick="openPage('Preguntas', this, 'orange')">Reviews</button>

    <div id="Caracteristicas" class="tabcontent">
        <h2>Descripción</h2>
        <h3 style="margin-left: 1em">
           <?php
                echo $productoActual->descripcion;
           ?>
        </h3>
    </div>

    <div id="Especificaciones" class="tabcontent">
        <h3>Disponibilidad</h3>
        <ul style="list-style-type: unset">

            <?php

                if($productoActual->stock > 100){
                    echo "<li>Actualmente disponemos de <b>".$productoActual->stock." unidades</b>  </li>";
                    echo "<li style='color: #00cc66'>Te llegará en menos de 14 días!</li>";
                    echo "<li style='color: yellowgreen'>Alta disponibilidad!</li>";

                } else if($productoActual->stock > 10 && $productoActual->stock < 50 ) {
                    echo "<li>Actualmente disponemos de <b>".$productoActual->stock." unidades</b>. ¡Date prisa que vuelan!  </li>";
                    echo "<li style='color: darkorange'>Te llegará en 1 mes</li>";
                    echo "<li style='color: yellowgreen'>¡Unidades en camino!</li>";

                } else if($productoActual->stock < 10){
                    echo "<li>¡Solo quedan <b>".$productoActual->stock." unidades!</b>  </li>";
                    echo "<li style='color: orangered'>Te llegará en 1 o 2 meses a partir de la compra</li>";
                    echo "<li style='color: yellowgreen'>¡Unidades en camino!</li>";
                } else if($productoActual->stock == 0){
                    echo "<li style='color: orangered'>Sin existencias</li>";
                    echo "<li style='color: yellowgreen'>¡Unidades en camino!</li>";
                }
                ?>
            </li>
            <li>Enviamos a Canarias y Baleares</li>
            <li>Fecha de adición: <b><?php echo substr($productoActual->created_at, 0, 10) ?></b></li>
            <li>Geolocaliza tu pedido</li>

        </ul>
    </div>

    <div id="Opiniones" class="tabcontent">


        <h3>Puntuaciones (a partir de las reviews)</h3>
        <span class="heading">Puntuación total</span>

        <span class="fa fa-star <?php if($media > 0.5){ echo "checked"; }  ?>"></span>
        <span class="fa fa-star <?php if($media > 1.5){ echo "checked"; }  ?>"></span>
        <span class="fa fa-star <?php if($media > 2.5){ echo "checked"; }  ?>"></span>
        <span class="fa fa-star <?php if($media > 3.5){ echo "checked"; }  ?>"></span>
        <span class="fa fa-star <?php if($media > 4.5){ echo "checked"; }  ?>"></span>
        <p><?php echo $media ?> estrellas de media en <?php echo $numeroReviews ?> reviews.</p>
        <hr style="border:3px solid #f1f1f1">

        <div class="row">
            <div class="side">
                <div>5 estrellas</div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div style="width:
                    <?php
                    if ($numeroReviews != 0) {
                        echo(($estrella5 * 100) / $numeroReviews);
                    }?>%" class="bar-5"></div>
                </div>
            </div>
            <div class="side right">
                <div><?php echo $estrella5 ?></div>
            </div>
            <div class="side">
                <div>4 estrellas</div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div style="width:

                    <?php
                    if ($numeroReviews != 0){
                    echo (($estrella4*100)/$numeroReviews);
                    } ?>%" class="bar-4"></div>

                </div>
            </div>
            <div class="side right">
                <div><?php echo $estrella4 ?></div>
            </div>
            <div class="side">
                <div>3 estrellas</div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div style="width:

                    <?php if($numeroReviews != 0){
                        echo (($estrella3*100)/$numeroReviews);
                    }  ?>%" class="bar-3"></div>
                </div>
            </div>
            <div class="side right">
                <div><?php echo $estrella3 ?></div>
            </div>
            <div class="side">
                <div>2 estrellas</div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div style="width:

                    <?php
                    if($numeroReviews != 0){
                        echo(($estrella2*100)/$numeroReviews);
                    }  ?>%" class="bar-2"></div>
                </div>
            </div>
            <div class="side right">
                <div><?php echo $estrella2 ?></div>
            </div>
            <div class="side">
                <div>1 estrella</div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div style="width:
                    <?php
                    if($numeroReviews != 0){
                        echo (($estrella1*100)/$numeroReviews);
                    } ?>%" class="bar-1"></div>
                </div>
            </div>
            <div class="side right">
                <div><?php echo $estrella1 ?></div>
            </div>
        </div>
    </div>

    <div id="Preguntas" class="tabcontent">
        <h3>Reviews:</h3>

        <?php

        $hayReviews = false;
        $reviewed = false;
        foreach($reviewsAll as $review){
            if($review->id_producto == $productoId){
                $hayReviews = true;
         ?>
                <?php
                foreach ($usersAll as $user){
                    if($user->id == $review->id_usuario){
                        $usuarioConReview = $user;
                    }
                }
                ?>

                <div style="  border: 1px dashed azure; box-shadow: 0px 5px 10px 0 rgba(0,0,0,0.3);
                <?php if($usuarioConReview->nombre == $username){
                    $puntuacionLogged = $review->puntuacion ;
                    $reviewLogged = $review->review ;
                    $reviewed=true; echo "background-color: crimson;";} ?>">


                <div style="background-color: #0C9A9A; display: inline-block;">


                <img class="avatarCabeceraImagen" style="width: 72px ;display: inline-block; margin-left: 2em;" src="<?php echo "img/avatar/" . $usuarioConReview->imagen ?>">
                <h4 style="    display: inline-block; vertical-align: bottom; margin-left: 1em; margin-right: 2em;" >
                <?php
                    echo $usuarioConReview->nombre;
                    ?></h4>

                </div>


                <p style="background-color: darkturquoise; padding: 2em;"><?php echo $review->review ?></p>
                <h4 style="margin-left: 2em">Puntuación: <?php echo $review->puntuacion ?> estrellas</h4>

                </div>

                <div class="separacionReviews" ></div>

        <?php
            }
        }

        if(!$hayReviews){
            echo "<h3 style='color: darkred; margin-left: 3em'>Actualmente no hay reviews para este producto</h3>";
        }

        $usuarioPuedeHacerReview = false;
        foreach ($ordenes as $orden) {
            if ($orden->id_usuario == $idUsuario) {
                $ordenesDetalle = pedidosController::getOrdenesDetalle($orden->id);
                foreach ($ordenesDetalle as $ordenDetalle) {
                    if ($productoId == $ordenDetalle->id_producto) {
                        $usuarioPuedeHacerReview = true;
                    }
                }
            }

        }
        if($usuarioPuedeHacerReview){
            if($reviewed){
            ?>
                <h3>Modifica tu review</h3>
                <form class="formularioReview" name="formularioReview" action="modificarReview<?php echo $productoId ?>">
                    Texto: <textarea class="formularioReviewText" type="text" placeholder="Escribe una review..." name="review"><?php echo $reviewLogged ?></textarea><br>
                    Puntuación [1 a 5 estrellas]: <input class="formularioReviewPuntuacion" type="number" value="<?php echo $puntuacionLogged ?>" max="5" min="1" name="puntuacion"><br>
                    <input class="formularioReviewEnviar" type="button" value="Enviar" onclick="comprobarReview();">
                </form>

            <?php
            }else{
            ?>
                <h3>¡Escribe tu review!</h3>
                <form class="formularioReview" name="formularioReview" action="procesarReview<?php echo $productoId ?>">
                    Texto: <input class="formularioReviewText" type="text" name="review" ><br>
                    Puntuación [1 a 5 estrellas]: <input class="formularioReviewPuntuacion" type="number" max="5" min="1" name="puntuacion"><br>
                    <input class="formularioReviewEnviar" type="button" value="Enviar" onclick="comprobarReview();">
                </form>

            <?php
            }
        }
        ?>






    </div>

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

</section>

<?php
}else{
    echo "<h3 style='text-align: center'>Producto no seleccionado</h3>";
}
?>

<?php include 'footer.php'; ?>


</body>
</html>
