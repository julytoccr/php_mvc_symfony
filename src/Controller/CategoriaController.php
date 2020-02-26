<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorias;
use App\Entity\Productos;


class CategoriaController extends AbstractController
{
    public function index(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CategoriaController.php',
        ]);
    }

    public function ver($id){

        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)
            ->findAll();

        //Leo todos los productos de esta categoria
        $productos = $this->getDoctrine()->getRepository(Productos::class)
            ->findBy(['categoria' => $id]);

        return $this->render('listado_productos.html.twig',[
            'categorias'=>$categorias,
            'productos'=>$productos
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
