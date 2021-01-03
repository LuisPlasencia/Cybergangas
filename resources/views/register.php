<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="CSS/main.css">
    <script type="text/javascript" src="js/comprobarRegister.js"></script>

</head>
<body>

<?php include 'header.php';?>

<h1 class="centerLoginH1">Registrarse</h1>

<form class="formularioLogin" method="get" id="formularioRegister" name="formularioRegister" action="procesarRegistro">

    <div class="formularioDivLogin">

        <p><input class="widerTextForm" type="text" placeholder="Nombre" size="15" name="nombre" id="nombre"></p>

        <p><input type="email" placeholder="Email" size="15" name="email" id="email"></p>

        <p><input type="password" placeholder="Contraseña" size="15" name="password" id="password" minlength="8" maxlength="14" pattern="[A-Za-z0-9]+"></p>

        <p><input type="password" placeholder="Repetir Contraseña" size="15" name="password2" id="password2" minlength="8" maxlength="14" pattern="[A-Za-z0-9]+"></p>

        <p class="justificado"><input type="checkbox" id="aceptarPolitica">He leído y acepto la <a href="privacidad"><u>política de privacidad</u></a></label></p>

        <p class="justificado"><input type="checkbox" id="recibirNovedades">Recibir <b>descuentos exclusivos</b>, novedades y tendencias por e-mail.</label></p>

        <input class="loginButton" type="button" value="Crear cuenta" onclick="comprobarDatosRegister();">

    </div>


</form>

<hr class="hrUno">

<h2 class="center">Ya tengo una cuenta</h2>

<div class="center">
    <form   method="get" name="register" action="login">
        <input class="createAccount" type="submit" value="Iniciar sesión">
    </form>

</div>

<?php include 'footer.php';?>

</body>
</html>
