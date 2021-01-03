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

        <a  class="iconUser" id="iconoPreferencias" style="background-color: #000"  href="settings">
            Preferencias
        </a>
        <a  class="iconUser" id="iconoPerfil" href="user">
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
        <form class="formularioEditarUsuario" name="formularioEditarUsuario" method="get" action="procesarEditarUsuario">
            Nombre de usuario: <input class="formularioEditarUsuarioElement" type="text" name="nombre" value="<?php echo $username ?>"><br>
            Nueva Contraseña: <input class="formularioEditarUsuarioElement" type="password" size="25" name="pass" minlength="6" maxlength="14" pattern="[A-Za-z0-9]+" ><br>
            Repetir contraseña: <input class="formularioEditarUsuarioElement" type="password" size="25" name="pass2" minlength="6" maxlength="14" pattern="[A-Za-z0-9]+" ><br>
            <input class="formularioEditarUsuarioSubmit" type="submit" class="botonCrear" value="Editar" onclick="comprobarEditarUsuario()">

        </form>

        <h3 class="settingsMainText">Seleccione una imagen:</h3><br>

        <div style="text-align: center">
            <form class="formularioEditarImagenDeUsuario" method="get" action="procesarEditarImagenUsuario">
                <img class="avatarFormularioEditarImagen"  src="/img/avatar/avatar1.png">
                <input name="imagen" type="hidden" value="avatar1.png">
                <input type="submit" value="Seleccionar">
            </form>
            <form class="formularioEditarImagenDeUsuario" method="get" action="procesarEditarImagenUsuario">
                <img class="avatarFormularioEditarImagen"  src="/img/avatar/avatar2.png">
                <input name="imagen" type="hidden" value="avatar2.png">
                <input type="submit" value="Seleccionar">
            </form>
            <form class="formularioEditarImagenDeUsuario" method="get" action="procesarEditarImagenUsuario">
                <img class="avatarFormularioEditarImagen"  src="/img/avatar/avatar3.png">
                <input name="imagen" type="hidden" value="avatar3.png">
                <input type="submit" value="Seleccionar">
            </form>
            <form class="formularioEditarImagenDeUsuario" method="get" action="procesarEditarImagenUsuario">
                <img class="avatarFormularioEditarImagen"  src="/img/avatar/avatar4.png">
                <input name="imagen" type="hidden" value="avatar4.png">
                <input type="submit" value="Seleccionar">
            </form>
            <form class="formularioEditarImagenDeUsuario" method="get" action="procesarEditarImagenUsuario">
                <img class="avatarFormularioEditarImagen"  src="/img/avatar/avatar5.jpg">
                <input name="imagen" type="hidden" value="avatar5.jpg">
                <input type="submit" value="Seleccionar">
            </form>
            <form class="formularioEditarImagenDeUsuario" method="get" action="procesarEditarImagenUsuario">
                <img class="avatarFormularioEditarImagen"  src="/img/avatar/avatar6.png">
                <input name="imagen" type="hidden" value="avatar6.png">
                <input type="submit" value="Seleccionar">
            </form>
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
