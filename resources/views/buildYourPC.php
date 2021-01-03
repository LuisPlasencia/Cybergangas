<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Build your PC</title>
    <link rel="stylesheet" href="CSS/main.css">

</head>
<body id="cuerpo">


<?php
include "header.php";
$productoAll = \App\Http\Controllers\productController::getProducts();
$email = session("email");
?>


<h1 class="centerLoginH1">Construye tu PC</h1>
<h3 style="text-align: center">El configurador de PC de Cybergangas es la herramienta perfecta para que elijas una a una
    las piezas de tu ordenador y pruebes distintas configuraciones y presupuestos.</h3>

<hr>
<div class="grid-container">
    <div class="centerDos">
        <div class="sectionHide">
            <button type="button" class="collapsible">Microprocesadores</button>
            <div class="content">
                <div class="row">
                    <?php
                    foreach ($productoAll as $producto) {
                        if ($producto->tipo == "cpu") {
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
                                                        <form name="formularioProducto" method="get" action="procesarBuild">
                                                            <input type="hidden" name="componente" value="<?php echo $producto->nombre."Dos"?>">
                                                            <input type="hidden" name="cantidadComponente" value="1">
                                                            <input class="botonCard" type="submit" value="Añadir"/>
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
                    if ($email == "admin") {
                        ?>
                        <button style="margin-left: 90px" class="botonCard" onclick="location.href = 'añadirProducto'">
                            Añadir producto
                        </button>
                        <?php
                    }
                    ?>

                </div>

            </div>
        </div>


        <button type="button" class="collapsible">Targetas gráficas</button>
        <div class="content">
            <div class="row">
                <?php
                foreach ($productoAll as $producto) {
                    if ($producto->tipo == "gpu") {
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
                                                    <form name="formularioProducto" method="get" action="procesarBuild">
                                                        <input type="hidden" name="componente" value="<?php echo $producto->nombre."Dos"?>">
                                                        <input type="hidden" name="cantidadComponente" value="1">
                                                        <input class="botonCard" type="submit" value="Añadir"/>
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
                if ($email == "admin") {
                    ?>
                    <button style="margin-left: 90px" class="botonCard" onclick="location.href = 'añadirProducto'">
                        Añadir producto
                    </button>
                    <?php
                }
                ?>
            </div>
        </div>

        <button type="button" class="collapsible">Memorias RAM</button>
        <div class="content">
            <div class="row">
                <?php
                foreach ($productoAll as $producto) {
                    if ($producto->tipo == "ram") {
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
                                                    <form name="formularioProducto" method="get" action="procesarBuild">
                                                        <input type="hidden" name="componente" value="<?php echo $producto->nombre."Dos"?>">
                                                        <input type="hidden" name="cantidadComponente" value="1">
                                                        <input class="botonCard" type="submit" value="Añadir"/>
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
                if ($email == "admin") {
                    ?>
                    <button style="margin-left: 90px" class="botonCard" onclick="location.href = 'añadirProducto'">
                        Añadir producto
                    </button>
                    <?php
                }
                ?>
            </div>
        </div>

    </div>
    <div>
        <div class="row">
            <?php
            echo "<table><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Añadir</th><th>Borrar</th></tr>";
            $productPriceFinal = 0;
            $precioTotal = 0;
            $numProductos = 0;
            foreach ($productoAll as $product) {
                if (session()->has($product->nombre . "Dos")) {
                    $cantidad = session($product->nombre . "Dos"); // La cantidad se obtiene con session del nombre del producto
                    $numProductos = $numProductos + $cantidad;

                    if($product->descuentoActivo){
                        $precio = $cantidad * ($product->precioConDescuento);
                    }else{
                        $precio = $cantidad * ($product->precio);
                    }


                    $precioTotal = $precioTotal + $precio;
                    $nombreComponente = $product->nombre . "Dos";
                    $nombreProducto = $product->nombre;
                    echo "<tr><td> $product->nombre";
                    echo "</td><td>$cantidad</td>";
                    echo "<td>$precio</td>";
                    echo "<td><form name='formularioProducto' method='get' action=procesarBuild>";
                    echo "<input type='hidden' name='componente'value='$nombreProducto'>";
                    echo "<input type='hidden' name='cantidadComponente'value='$cantidad'>";
                    echo "<input class='botonEliminar' type='submit' name='AñadirProducto' value='Añadir'>";
                    echo "</form></td>";
                    echo "<td><form method='get' action=eliminarComponentes>";
                    echo "<input type='hidden' name='componente' value='$nombreComponente'>";
                    echo "<input class='botonEliminar' type='submit' name='EliminarComponente' value='Eliminar'>";
                    echo "</form></td></tr>";
                }
            }
            echo "</table>";
            ?>
        </div>
        <?php echo "<p style='text-align: center' class='textoOne'>Total: $precioTotal €</p>"; ?>
        <?php echo "<p style='text-align: center' class='textoOne'>Unidades: $numProductos</p>"; ?>





        <form method='get' action='vaciarComponentes'>
            <div class="grid-item">
                <input class="botonCardDos" type='submit' name='Vaciar' value='Vaciar'>
            </div>
        </form>
    </div>
</div>


<?php include 'footer.php'; ?>

<!--Para el colapsite-->
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>

</body>
</html>
