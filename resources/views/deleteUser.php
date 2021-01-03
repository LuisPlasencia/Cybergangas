<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>

    <link rel="stylesheet" href="CSS/main.css">

</head>
<body id="cuerpo">

<?php include 'header.php';

use App\Http\Controllers\wishListController;

$login = session('login');
$username = session('name');
$email = session('login');
$avatar = session('avatar');
$fecha = session('fecha');
$avatar = session('avatar');
$id = session('user');
$wishListLogged = wishListController::getWishListItemsLogged();

if($login){
    ?>


    <div class="barraIconos" id="iconUser">
        <a  class="iconUser" id="iconoPedidos" href="misPedidos">
            Mis pedidos
        </a>

        <a  class="iconUser" id="iconoPreferencias" href="settings">
            Preferencias
        </a>
        <a  class="iconUser" id="iconoPerfil" style="background-color: #000" href="user">
            Mi Perfil
        </a>
        <a  class="iconUser" id="iconoReviews" href="reviews">
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


    <div class="contenedorMiCuenta">

        <h1 class="deleteUserMainText"> ¿Está seguro de que desea borrar todos sus datos?</h1>
        <h3 class="deleteUserSideText"> Cualquier pedido pendiente e información sobre usted se borrará de la base de datos</h3>

        <form class="deleteUserFormYes" type="get" name="confirmacionSi" action="borrarPerfil">
            <input class="deleteUserInputYes" type="submit" value="Sí, bórrame todo" >
        </form>


        <form class="deleteUserFormNo" type="get" name="confirmacionNo" action="user">
            <input class="deleteUserInputNo" type="submit" value="No" >
        </form>

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
