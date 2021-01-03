<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ordenes;
use App\OrdenesDetalle;


class pedidosController extends Controller
{
    public static function getOrdenesLogged(){
        $items = Ordenes::where('id_usuario', session('user'))->get();
        return $items;
    }

    public static function getOrdenesDetalle($id){
        $items = OrdenesDetalle::where('id_orden', $id)->get();
        return $items;
    }
}
