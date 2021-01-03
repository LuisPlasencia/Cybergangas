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
    <a class="iconosPerfil" href= "deleteUser" > <img src="img/papelera.png"></a>
<!--    <a class="iconosPerfil"  href= "settings" > <img src="img/engranaje.png"></a>-->

    <div class="avatarPerfilContenedor" >

        <div>
            <a href="user">
                <img class="avatarPerfilImagen" src="<?php echo "img/avatar/".$avatar  ?>">
            </a>
        </div>

        <div class="informacionPerfilContenedor">

            <p class = username_informacion>Nombre de Usuario: <?php echo $username ?></p>
            <p class = username_date>Miembro desde: <?php echo substr($fecha, 0, 10) ?></p>

        </div>

    </div>


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
