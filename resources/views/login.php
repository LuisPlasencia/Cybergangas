<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="CSS/main.css">
    <script type="text/javascript" src="js/comprobarLogin.js"></script>

</head>
<body id="cuerpo">

<?php include 'header.php';

if(session()->has('popup')){
    echo '<script type="text/javascript">alert("You must be logged in order to add items!!!")</script>';
}
?>

<h1 class="centerLoginH1">Iniciar sesión</h1>

<form class="formularioLogin" method="get" id="formularioLogin"  name="formularioLogin" action="procesarLogin" >

    <div class="formularioDivLogin">

        <p><input type="email" placeholder="Email" size="15" name="email" id="email"></p>

        <p><input type="password" placeholder="Password" size="15" name="password" id="password" minlength="8" maxlength="14" pattern="[A-Za-z0-9]+"></p>

        <input class="loginButton" type="button" value="Login" onclick="comprobarDatosLogin();">

    </div>


</form>

<hr class="hrUno">

<h2 class="center">¿Eres nuevo cliente?</h2>

<div class="center">
    <form method="get" name="register" action="register">
        <input style="margin-bottom: 290px" class="createAccount" type="submit" value="Crear Cuenta">
    </form>

</div>
</div>
<?php include 'footer.php';?>

</body>
</html>
