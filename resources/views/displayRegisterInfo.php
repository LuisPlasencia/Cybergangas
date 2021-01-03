<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>displayRegisterInfo</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <?php
    $nombreRegistrado = $_GET["nombre"];
    $emailRegistrado = $_GET["email"];
    ?>
</head>
<body id="cuerpo">

<?php
include "header.php" ;
?>

<section id="seccionDisplay">
    <h1>Se ha validado correctamente con los siguiente datos:</h1>
    <article class = "articulo_inicial" >
        <div  class="divisorDisplay" >
            <p style="display: inline" class="info_text">Nombre de Usuario:</p> <p style="display: inline" class="main_text"><?php echo $nombreRegistrado?></p>
        </div>
        <div class="divisorDisplay">
            <p style="display: inline" class="info_text">Email:</p>  <p style="display: inline" class="main_text"><?php echo $emailRegistrado?></p>
        </div>
    </article>
</section>

<?php
include "footer.php" ;
?>

</body>
</html>
