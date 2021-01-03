<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Wishlists;
use Illuminate\Http\Request;

class wishListController extends Controller
{
    public static function getWishListItems(){

        return Wishlists::all();
    }

    public static function getWishListItemsLogged(){
        $items = Wishlists::where('id_usuario', session('user'))->get();
        return $items;
    }

    public function procesarWishList($id)
    {
        $productoAll = productController::getProducts();
        $wishListAll = self::getWishListItemsLogged();

        foreach ($productoAll as $producto) {
            if ($producto->id == $id) {
                if (session("user") == null) {
                    return redirect()->to("login")->with('popup', 'open');
                }
                foreach ($wishListAll as $lista) {
                    if ($lista->id_producto == $id) {
                        return redirect()->to("detail")->with('popupDos', 'open');;
                    }
                }
                $wishList = new Wishlists();
                $wishList->id_usuario = session("user");
                $wishList->id_producto = $id;
                $wishList->save();

                return redirect()->to("detail")->with('popupTres', 'open');
            }
        }

    }

    public function deleteWishListItem($id)
    {
        Wishlists::where('id', $id)->delete();
        return redirect()->to('wishList');
    }
}
