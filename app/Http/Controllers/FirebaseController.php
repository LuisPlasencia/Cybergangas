<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase;

use Kreait\Firebase\Factory;

use Kreait\Firebase\ServiceAccount;

use Kreait\Firebase\Database;

class FirebaseController extends Controller

{


    public function index($id)
    {

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/firebase_credentials.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://cybergangas-70918-default-rtdb.firebaseio.com')
            ->create();

        $database = $firebase->getDatabase();

//        $newPost = $database
//            ->getReference('blog/posts')
//            ->push(['title' => 'Post title', 'body' => 'This should probably be longer.']);
//
//        echo "<pre>";
//
//        print_r($newPost->getvalue());

        $newPost = $database
            ->getReference('Orden')->getChild($id);

//        echo "<pre>";

//        print_r($newPost->getvalue());
        return $newPost->getvalue();
    }

    public function getLocation($id){
        $json = $this->index($id);

        if($json == null || $json == ""){
            return "<h3>Pedido no registrado</h3>";
        }

        foreach ($json as $item => $val ){
            session([$item => $val]);
        }

        return redirect()->to('seguimiento');
    }

    public static function createChild($id){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/firebase_credentials.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://cybergangas-70918-default-rtdb.firebaseio.com')
            ->create();

        $database = $firebase->getDatabase();

        $newPost = $database
            ->getReference('Orden/'.$id)->set(['latitud' => 28.071308, 'longitud' => -15.453189]);
    }

}
