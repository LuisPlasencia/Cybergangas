<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Usuario;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function procesarLogin(){

        if(isset($_GET["email"], $_GET["password"])){

            $email = $_GET["email"];
            $password = $_GET["password"];

            $usuario = Usuario::where('email', $email) -> get();

            if($usuario == '[]'){ // si esta vacio o no existe

                return "<h3>El email no existe</h3>";

            }

            if($usuario[0]['email'] == $email && $usuario[0]['passwd'] == md5($password)){

                $id = $usuario[0]['id'];
                $name = $usuario[0]['nombre'];
                $email = $usuario[0]['email'];
                $imagen = $usuario[0]['imagen'];
                $fecha = $usuario[0]['created_at'];

                $login = true;

                session(['user' => $id]);
                session(['name' => $name]);
                session(['login' => $login]);
                session(['email' => $email]);
                session(['avatar' => $imagen]);
                session(['fecha' => $fecha]);

            //Vamos a almecenar una cookies que expiran en 1 hora que nos mantengan la sesion abierta
                $expiryTime = time()+60*60*1;

                $cookiename = "user";
                $value = $id;
                setcookie($cookiename, $value, $expiryTime);

                $cookiename = "name";
                $value = $name;
                setcookie($cookiename, $value, $expiryTime);

                $cookiename = "login";
                $value = $login;
                setcookie($cookiename, $value, $expiryTime);

                $cookiename = "email";
                $value = $email;
                setcookie($cookiename, $value, $expiryTime);

                $cookiename = "avatar";
                $value = $imagen;
                setcookie($cookiename, $value, $expiryTime);

                $cookiename = "fecha";
                $value = $fecha;
                setcookie($cookiename, $value, $expiryTime);


                return redirect()->to('/user');

            } else {
                return "<h3>La contraseña es incorrecta</h3>";
            }

        } else {

            return "<h3>Rellene todos los campos</h3>";
        }

    }

    public function logout(){
        //limpiamos las sesiones
        session()->flush();

        //limpiamos las cookies
        setcookie("user","", time()-3600);
        unset ($_COOKIE['user']);

        setcookie("name","", time()-3600);
        unset ($_COOKIE['name']);

        setcookie("login","", time()-3600);
        unset ($_COOKIE['login']);

        setcookie("email","", time()-3600);
        unset ($_COOKIE['email']);

        setcookie("avatar","", time()-3600);
        unset ($_COOKIE['avatar']);

        setcookie("fecha","", time()-3600);
        unset ($_COOKIE['fecha']);



        return redirect()->to("/");
    }
}
