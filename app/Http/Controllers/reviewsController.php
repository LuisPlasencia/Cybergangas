<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reviews;

class reviewsController extends Controller
{
    public static function getReviewsFromLogged(){
        $items = Reviews::where('id_usuario', session('user'))->get();
        return $items;
    }

    public static function getReviews(){
        return Reviews::all();
    }

    public function deleteReview($id){
        $review = Reviews::find($id);
        $review->delete();
        return redirect()->to('reviews');
    }

    public function modificarReview($id){
        if(isset($_GET["review"], $_GET["puntuacion"])){
            $reviewForm = $_GET["review"];
            $puntuacionForm = $_GET["puntuacion"];
            $reviews = Reviews::where('id_usuario', session('user'))->get();

            foreach($reviews as $review){
                if($review->id_producto == $id){
                    $review->review = $reviewForm;
                    $review->puntuacion = $puntuacionForm;
                    $review->save();
                    break;
                }
            }
        }
        return redirect()->back();
    }

    public function procesarReview($id){
        if(isset($_GET["review"], $_GET["puntuacion"])){
            $reviewForm = $_GET["review"];
            $puntuacionForm = $_GET["puntuacion"];

            $review = new Reviews();
            $review->review = $reviewForm;
            $review->puntuacion = $puntuacionForm;
            $review->id_producto = $id;
            $review->id_usuario = session('user');
            $review->save();


        }
        return redirect()->back();

    }
}
