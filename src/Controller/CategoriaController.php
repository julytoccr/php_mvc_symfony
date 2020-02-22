<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaController extends AbstractController
{
    public function index(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CategoriaController.php',
        ]);
    }

    public function ver(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CategoriaController.php',
        ]);
    }

    public function crear(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CategoriaController.php',
        ]);
    }

    public function save(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CategoriaController.php',
        ]);
    }



}
