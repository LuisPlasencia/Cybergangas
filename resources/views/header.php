<header id="header">

<!--    funcionalidad de search -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myList li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

<!--    slide in  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#myInput").click(function(){
                $("#panel").slideDown("slow");
                $(".sectionHide").hide();
            });
        });
    </script>

    <a href="/"> <img id="logo" src="/img/logo.png" alt="logo" title="logo"/> </a>
    <!--    <button class = "botonesCabecera"><a href="index.php">MyWebIoT</a></button>-->
    <form class="formCabecera" name="formularioBusqueda" method="get" action="/">
        <input id="myInput" class="inputCabecera" type="text" placeholder="Buscar...">
        <input value="" class="submitSearch">
    </form>

    <?php

    use App\Http\Controllers\productController;

    $eliminar = 0;
    $login = session('login');
    $username = session('name');
    $avatar = session('avatar');


    $productosAll = productController::getProducts();
    $email = session('email');


    if(session('vaciarCarritoDespuesDeCompra')){
        productController::vaciarCarritoDespuesDeCompra();
    }
    ?>

    <?php
    if ($login){ ?>

    <div id="cabeceraDerechaLogeado" <?php if (!$login) {
        echo "Style= \"margin-top:2.7em;\"";
    } ?> >
        <a href="user" class="avatarCabeceraNombre"><?php echo $username ?></a>
        <div class="avatarCabeceraContenedor">
            <a href="user">
                <img class="avatarCabeceraImagen" src="<?php echo "img/avatar/" . $avatar ?>">
            </a>
        </div>

        <?php
        }else{
        ?>

        <div id="cabeceraDerecha" <?php if (!$login) {
            echo "Style= \"margin-top:2.7em;\"";
        } ?> >
            <a class="botonesCabecera" <?php if ($eliminar == 1) {
                echo "id=\"linkdisabled\"";
            } else {
                echo "href=\"login\"";
            } ?> >Mi cuenta</a>

            <?php
            }
            ?>

        </div>

        <div id="mySidenav" class="sidenavRight">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNavRight()">&times;</a>

            <div style="padding: 20px" class="row">
                <?php
                //  Mostrar carrito
                echo "<table><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Borrar</th></tr>";
                $productPriceFinal = 0;
                $precioTotal = 0;
                $numProductos = 0;
                foreach ($productosAll as $product) {
                    if (session()->has($product->nombre)) {
                        $cantidad = session($product->nombre); // La cantidad se obtiene con session del nombre del producto
                        $numProductos = $numProductos + $cantidad;

                        if($product->descuentoActivo){
                            $precio = $cantidad * ($product->precioConDescuento);
                        }else{
                            $precio = $cantidad * ($product->precio);

                        }
                        $precioTotal = $precioTotal + $precio;


                        echo "<tr><td> $product->nombre";
                        echo "</td><td>$cantidad</td>";
                        echo "<td>$precio</td>";
                        echo "<td><form method='get' action=eliminarProduct>";
                        echo "<input type='hidden' name='producto' value='$product->nombre'>";
                        echo "<input class='botonEliminar' type='submit' name='Eliminar' value='Eliminar'>";
                        echo "</form></td></tr>";
                    }
                }
                echo "</table>";
                ?>
            </div>

            <?php echo "<p style='text-align: center' class='textoOne'>Total: $precioTotal €</p>"; ?>
            <?php echo "<p style='text-align: center' class='textoOne'>Unidades: $numProductos</p>"; ?>

            <div class="grid-container">

                <form  method='get' action='vaciarCarrito'>
                    <div class="grid-item">
                        <input class="botonCardDos" type='submit' name='Vaciar' value='Vaciar'>
                    </div>
                </form>


                <?php
                if ($email == null){
                ?>
                <form name="pago" method='get' action="<?php echo "login" ?>">
                    <?php
                    } else {
                    if ($precioTotal != 0){
                    ?>
                    <form name="pago" method='get' action="checkout">
                        <?php
                        }
                    }
                        ?>
                        <div class="grid-item">
                            <input type="hidden" name="cantidadFinal" value="<?php echo $precioTotal ?>">
                            <input class="botonCardDos" type="submit" name="pay" value="Pagar">
                        </div>
                    </form>
            </div>
        </div>


        <span class="openbtn2" onclick="openNavRight()">&#9776; Mi Carrito</span>

        <script>
            function openNavRight() {
                document.getElementById("mySidenav").style.width = "350px";
                document.getElementById("main").style.marginRight = "300px";
            }

            function closeNavRight() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginRight = "0";
            }
        </script>

</header>


<script>

    /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
    function openNav() {
        document.getElementById("mySidebar").style.width = "300px";
        document.getElementById("main").style.marginLeft = "300px";
    }

    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }

</script>

<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div>
        <p>Componentes de PC</p>
        <button class="buttonLink" onclick="location.href = '<?php echo "gpu" ?>'">Gráficas</button>
        <button class="buttonLink" onclick="location.href = '<?php echo "cpu" ?>'">Microprocesadores</button>
        <button class="buttonLink" onclick="location.href = '<?php echo "ram" ?>'">Memorias RAM</button>
    </div>

    <div>
        <p>Electrodomésticos</p>
        <button class="buttonLink" onclick="location.href = '<?php echo "microondas" ?>'">Microondas</button>
        <button class="buttonLink" onclick="location.href = '<?php echo "lavadoras" ?>'">Lavadoras</button>
        <button class="buttonLink" onclick="location.href = '<?php echo "cafeteras" ?>'">Cafeteras</button>
    </div>

    <div>
        <p>Smartphones</p>
        <button class="buttonLink" onclick="location.href = '<?php echo "android" ?>'">Móviles Android</button>
        <button class="buttonLink" onclick="location.href = '<?php echo "iphone" ?>'">Móviles iPhone</button>
        <button class="buttonLink" onclick="location.href = '<?php echo "accesorios" ?>'">Accesorios</button>
    </div>


</div>


<div id="main">
    <button class="openbtn" onclick="openNav()">&#9776; Categorías</button>
    <!--    Contenido-->



