<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Usuario;
use Illuminate\Http\Request;

class registerController extends Controller
{
    public function procesarRegistro(){

        if(isset($_GET["nombre"],$_GET["email"],$_GET["password"],$_GET["password2"])){

            $nombre = $_GET["nombre"];
            $email = $_GET["email"];
            $password = $_GET["password"];
            $password2 = $_GET["password2"];

            if (Usuario::where('email', '=', $email)->exists()) {

                return "<h3>El email ya existe</h3>";

            } else if(Usuario::where('nombre', '=', $nombre)->exists()){

                return "<h3>Nombre de usuario ya existe. Elija otro por favor.</h3>";
            }

            else {

                $email = $_GET ['email'];

                $expiryTime = time()+10 * 365 * 24 * 60 * 60;
                $name = "email";
                $value = $email;
                setcookie($name, $value, $expiryTime);


                $usuario = new Usuario;
                $usuario->nombre = $nombre;
                $usuario->email = $email;
                $usuario->passwd = md5($password);
                $usuario->imagen = "default.png";

                $usuario->save();

                return view('displayRegisterInfo');

            }

        } else {

            return "<h3>No se han rellenado todos los datos</h3>";

        }

    }
}
