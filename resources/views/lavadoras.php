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

include "header.php";

$email = session('email');

$productAll = productController::getProducts();

$tipo = "lavadoras";
session(['tipo' => $tipo]);
$productoType = productController::getNumberOfThatProduct($tipo);

if(session('ascendente')){
    for ($i = 0; $i < count($productAll)-1; ++$i){
        for ($j = $i+1; $j < count($productAll); ++$j){
            if($productAll[$j]->precio > $productAll[$i]->precio){
                $productoActual = $productAll[$j];
                $productAll[$j] = $productAll[$i];
                $productAll[$i] = $productoActual;
            }
        }

    }
    session()->forget('ascendente');

} else if(session('descendente')){
    for ($i = 0; $i < count($productAll)-1; ++$i){
        for ($j = $i+1; $j < count($productAll); ++$j){
            if($productAll[$j]->precio < $productAll[$i]->precio){
                $productoActual = $productAll[$j];
                $productAll[$j] = $productAll[$i];
                $productAll[$i] = $productoActual;
            }
        }

    }
    session()->forget('descendente');
}
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
                </li>
                <?php
            }
            ?>

        </ul>
    </div>
</section>
<div class="sectionHide">
    <section class="sectionTwo">
        <?php
        ?>
        <h2>Lavadoras</h2>
        <p class="ordenarPorPrecio" >Ordenar por precio:</p><a class="ordenarascendente" href="ordenarAscendente">Ascendente</a><a class="ordenardescendente" href="ordenarDescendente">Descendente</a>
        <?php
        ?>
        <div class="row">
            <?php
            if($productoType!=0){
                foreach ($productAll as $producto) {
                    if ($producto->tipo == $tipo) {
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
                                                    <h2 style="padding-left: 3vw"><?php echo $producto->precioConDescuento . "€" ?></h2>
                                                </div>
                                                <div class="column">
                                                    <h2 style="padding-left: 6vw; color: red" class="center"> <strike><?php echo $producto->precio . "€" ?> </strike></h2>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <h2 class="center"><?php echo $producto->precio . "€" ?></h2>
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
                }
            }else {
                ?>
                <p>Actualmente no estan disponibles los productos de esta sección</p>
                <?php
            }
            if ($email == "administrador@gmail.com") {
                ?>
                <button style="margin-left: 90px" class="botonCard" onclick="location.href = 'añadirProducto'">Añadir
                    producto
                </button>
                <?php
            }
            ?>
        </div>

    </section>
</div>


<?php include 'footer.php'; ?>

</body>
</html>
