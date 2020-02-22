<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CarritoController extends AbstractController
{
    public function index(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CarritoController.php',
        ]);
    }

    public function add(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CarritoController.php',
        ]);
    }

    public function delete(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CarritoController.php',
        ]);
    }

    public function up(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CarritoController.php',
        ]);
    }

    public function down(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CarritoController.php',
        ]);
    }

    public function delete_all(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CarritoController.php',
        ]);
    }

}
