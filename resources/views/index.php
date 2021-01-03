<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>

    <link rel="stylesheet" href="CSS/main.css">

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <script>
        function get_time(){
            $("#numberofuser").load("ajaxUsers");
            $("#numberofProducts").load("ajaxProducts");
            $("#lastUser").load("ajaxLastUser");
            setTimeout(get_time,2000);
        }
    </script>

    <script src="js/highcharts.js"></script>
    <script src="js/modules/data.js"></script>
    <script src="js/modules/exporting.js"></script>
    <script src="js/modules/export-data.js"></script>

    <?php
    //Recogemos las cookies. Esto es útil cuando el usuario cierrra el navegador. Estas cookies se generan al hacer login y duran 1 hora exacta
    if(isset($_COOKIE['user'], $_COOKIE['name'], $_COOKIE['login'], $_COOKIE['email'], $_COOKIE['avatar'], $_COOKIE['fecha'])){
    session(['user' => $_COOKIE['user']]);
    session(['name' => $_COOKIE['name']]);
    session(['login' => $_COOKIE['login']]);
    session(['email' => $_COOKIE['email']]);
    session(['avatar' => $_COOKIE['avatar']]);
    session(['fecha' => $_COOKIE['fecha']]);
    }
    ?>

</head>
<body id="cuerpo">

<?php

use App\Http\Controllers\productController;

include "header.php";
$productAll = productController::getProducts();
$email = session('email');
$numberOfProducts = productController::getNumberOfProducts();
$productAllReverse = productController::getProductsReverse();

?>

<section>
    <div id="panel">
        <ul id="myList">
        <?php
        foreach ($productAll as $producto){
            ?>
            <li>
            <div class="column">
                <div class="containerDos">
                    <div class="card">
                        <img src="<?php echo "img/" . $producto->tipo . "/" . $producto->imagen . ".png" ?>" alt="imagen" style="width:100%">
                        <div class="container">
                            <h2 style="font-family: 'Comic Sans MS'"
                                class="center"><?php echo $producto->nombre ?></h2>
                            <div class="row">
                                <div class="column">
                                    <h2 style="padding-left: 20px">
                                        <?php echo $producto->precioConDescuento . "€" ?>
                                    </h2>
                                </div>
                                <div class="column">
                                    <h2 class="center" style="color: red" ><strike><?php echo $producto->precio . "€" ?></strike></h2>
                                </div>
                                <div class="column">
                                    <h4 style="padding-left: 40px"><?php echo $producto->descuentoActivo ?></h4>
                                </div>

                                <div class="overlay">
                                    <div class="buttonHover">
                                        <button class="botonCard"
                                                onclick="location.href = '<?php echo "goToDetail" . $producto->id ?>'">
                                            Ver detalle
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </li>
            <?php
        }
        ?>

        </ul>
    </div>
</section>

<div class="sectionHide">
    <section>
        <article>
            <div style="float: right; padding: 20px;mar">

                <?php
                if ($email == "administrador@gmail.com") {
                    ?>
                    <hr>
                    <table>
                        <tr>
                            <th>Número de usuarios: </th>
                            <th><div id="numberofuser"></div></th>
                        </tr>
                        <tr>
                            <th>Número de productos: </th>
                            <th><div id="numberofProducts"></div></th>
                        </tr>
                    </table>
                    <script>
                        setTimeout(get_time,1000);
                    </script>
                    <hr>
                    <?php
                }
                ?>

            </div>
            <div class="sectionOne">
                <button onclick="location.href = '<?php echo "buildYourPC" ?>'" class="botonPrimero">Configura tu PC</button>
            </div>
            <section class="sectionTwo">
                <h2>Últimos artículos</h2>
                <div class="row">
                    <?php
                    $contador = 4;
                    foreach ($productAllReverse as $producto) {
                        ?>
                        <div class="column">
                            <div class="containerDos">
                                <div class="card">
                                    <img
                                        src="<?php echo "img/" . $producto->tipo . "/" . $producto->imagen . ".png" ?>"
                                        alt="imagen" style="width:100%">
                                    <div class="container">
                                        <h2 style="font-family: 'Comic Sans MS'"
                                            class="center"><?php echo $producto->nombre ?></h2>
                                        <div class="row">
                                            <?php
                                            if($producto->descuentoActivo){
                                                ?>
                                                <div class="column">
                                                    <h2 style="padding-left: 3vw"><?php echo $producto->precioConDescuento . "€" ?></h2>
                                                </div>

                                                <div class="column">
                                                    <h2 style="padding-left: 5vw; color: red"> <strike><?php echo $producto->precio . "€" ?> </strike></h2>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <h2 style="padding: 20px" class="center"><?php echo $producto->precio . "€" ?></h2>
                                                <?php
                                            }
                                            ?>
                                            <div class="overlay">
                                                <div class="buttonHover">
                                                    <?php
                                                    if ($email == "administrador@gmail.com") {
                                                        ?>
                                                        <div style="text-align: center">
                                                            <form action="<?php echo "editProductVista" . $producto->id ?>">
                                                                <input class="botonCard" type="submit" value="Editar"/>
                                                            </form>
                                                            <form name="productoDelete"
                                                                  action="<?php echo "deleteProduct" . $producto->id ?>">
                                                                <input class="botonCard" type="submit" value="Borrar"/>
                                                            </form>
                                                            <button class="botonCard" onclick="location.href = '<?php echo "goToDetail" . $producto->id ?>'">Ver detalle</button>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button class="botonCard" onclick="location.href = '<?php echo "goToDetail" . $producto->id ?>'">Ver detalle</button>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (--$contador == 0) break;
                    }
                    ?>
                </div>
            </section>
        </article>



            <section class="sectionThree">
                <h2>Artículos con descuento</h2>
                <div class="row">
                    <?php
                    $contador = 5;
                    foreach ($productAllReverse as $producto) {
                        if ($producto->descuentoActivo == 1) {
                            ?>
                            <div class="column">
                                <div class="containerDos">
                                    <div class="card">
                                        <img
                                            src="<?php echo "img/" . $producto->tipo . "/" . $producto->imagen . ".png" ?>"
                                            alt="imagen" style="width:100%">
                                        <div class="container">
                                            <h2 style="font-family: 'Comic Sans MS'"
                                                class="center"><?php echo $producto->nombre ?></h2>
                                            <div class="row">
                                                <?php
                                                if($producto->descuentoActivo){
                                                    ?>
                                                    <div class="column">
                                                        <h2 style="padding-left: 3vw"><?php echo $producto->precioConDescuento . "€" ?></h2>
                                                    </div>

                                                    <div class="column">
                                                        <h2 style="padding-left: 5vw; color: red"> <strike><?php echo $producto->precio . "€" ?> </strike></h2>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <h2 style="padding: 20px" class="center"><?php echo $producto->precio . "€" ?></h2>
                                                    <?php
                                                }
                                                ?>
                                                <div class="overlay">
                                                    <div class="buttonHover">
                                                        <?php
                                                        if ($email == "administrador@gmail.com") {
                                                            ?>
                                                            <div style="text-align: center">
                                                                <form action="<?php echo "editProductVista" . $producto->id ?>">
                                                                    <input class="botonCard" type="submit" value="Editar"/>
                                                                </form>
                                                                <form name="productoDelete"
                                                                      action="<?php echo "deleteProduct" . $producto->id ?>">
                                                                    <input class="botonCard" type="submit" value="Borrar"/>
                                                                </form>
                                                                <button class="botonCard" onclick="location.href = '<?php echo "goToDetail" . $producto->id ?>'">Ver detalle</button>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <button class="botonCard" onclick="location.href = '<?php echo "goToDetail" . $producto->id ?>'">Ver detalle</button>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        if (--$contador == 0) break;
                    }
                    ?>

                </div>
            </section>
        </article>
    </section>
</div>

<script>
    setTimeout(get_time,1000);
</script>
<?php include 'footer.php'; ?>

</body>
</html>
