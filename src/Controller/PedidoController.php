<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PedidoController extends AbstractController
{
    public function hacer(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PedidoController.php',
        ]);
    }

    public function add(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PedidoController.php',
        ]);
    }

    public function confirmado(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PedidoController.php',
        ]);
    }

    public function mis_pedidos(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PedidoController.php',
        ]);
    }

    public function detalle(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PedidoController.php',
        ]);
    }

    public function gestion(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PedidoController.php',
        ]);
    }

    public function estado(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PedidoController.php',
        ]);
    }

}
