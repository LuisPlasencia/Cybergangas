<?php

namespace App\Http\Controllers;

use App\Facturas;
use App\Ordenes;
use App\OrdenesDetalle;
use App\Reviews;
use App\Wishlists;
use Illuminate\Http\Request;
use App\Usuario;


class userController extends Controller
{
    public function borrarPerfil(){
        //borramos primero todo lo relacionado con ese usuario
        $facturas = Facturas::where('id_usuario', session('user'));
        $facturas->delete();

        $ordenes = Ordenes::where('id_usuario', session('user'));

        $ordenesDetalle = OrdenesDetalle::all();
        foreach ($ordenes as $orden) {
            foreach ($ordenesDetalle as $ordenDetalle){
                if($ordenDetalle->id_orden == $orden->id){
                    $ordenDetalle->delete();
                }
            }
        }
        $ordenes->delete();

        $reviews = Reviews::where('id_usuario', session('user'));
        $reviews->delete();

        $wishLists = Wishlists::where('id_usuario', session('user'));
        $wishLists->delete();


        $usuario = Usuario::find(session('user'));
        $usuario->delete();


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

    public function procesarEditarUsuario(){

        if(isset($_GET["nombre"])){
            $usernameActual = session('name');
            $usernameNuevo = $_GET["nombre"];
            if($usernameNuevo != $usernameActual){

                $nombresDeUsuario = Usuario::all();
                foreach ($nombresDeUsuario as $usuario){
                    if($usuario->nombre == $usernameNuevo){
                        return  "<h3>Dicho nombre de usuario ya existe. Por favor, elija uno distinto.";
                    }
                }
                $modNombreUsuario = Usuario::where('id', session('user'))->update(array('nombre' => $usernameNuevo));
                session(['name' => $usernameNuevo]);

            }

            if(isset($_GET["pass1"], $_GET["pass2"])){
                $pass1 = md5($_GET["pass1"]);
                $pass2 = md5($_GET["pass2"]);

                if($pass1 == $pass2){
                    $modPasswordUsuario = Usuario::where('id', session('user'))->update(array('passwd' => $pass1));
                }
            }
        }

        return redirect()->to('user');
    }

    public function procesarEditarImagenUsuario(){
        if(isset($_GET["imagen"])){
            $imagen = $_GET["imagen"];
            $modImagenUsuario = Usuario::where('id', session('user'))->update(array('imagen' => $imagen));
            session(['avatar' => $imagen]);
        }
        return redirect()->to('user');
    }

    public static function getUsers(){
        return Usuario::all();
    }

}
