<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    public function index(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ErrorController.php',
        ]);
    }

    public function error404(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ErrorController.php',
        ]);
    }
}
