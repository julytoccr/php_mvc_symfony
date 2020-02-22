<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductoController extends AbstractController
{

    public function index(){
        return $this->json([
            'message' => 'Weaaalcome to your new controller!',
            'path' => 'src/Controller/ProductoController.php',
        ]);
    }

    public function ver(){
        return $this->json([
            'message' => 'Weaaalcome to your new controller!',
            'path' => 'src/Controller/ProductoController.php',
        ]);
    }

    public function gestion(){
        return $this->json([
            'message' => 'Weaaalcome to your new controller!',
            'path' => 'src/Controller/ProductoController.php',
        ]);
    }

    public function crear(){
        return $this->json([
            'message' => 'Weaaalcome to your new controller!',
            'path' => 'src/Controller/ProductoController.php',
        ]);
    }

    public function save(){
        return $this->json([
            'message' => 'Weaaalcome to your new controller!',
            'path' => 'src/Controller/ProductoController.php',
        ]);
    }

    public function editar(){
        return $this->json([
            'message' => 'Weaaalcome to your new controller!',
            'path' => 'src/Controller/ProductoController.php',
        ]);
    }

    public function eliminar(){
        return $this->json([
            'message' => 'Weaaalcome to your new controller!',
            'path' => 'src/Controller/ProductoController.php',
        ]);
    }

    public function obtenerImagen(){
        return $this->json([
            'message' => 'Weaaalcome to your new controller!',
            'path' => 'src/Controller/ProductoController.php',
        ]);
    }
}
