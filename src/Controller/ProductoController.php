<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Categorias;
use App\Entity\Productos;

class ProductoController extends AbstractController
{

    public function index(){

        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        //Leo todos los productos
        $productos = $this->getDoctrine()->getRepository(Productos::class)
            ->findAll();


        return $this->render('listado_productos.html.twig',[
            'categorias'=>$categorias,
            'productos'=>$productos
        ]);
    }

    public function ver(){
        return $this->json([
            'message' => 'vvv to your new controller!',
            'path' => 'src/Controller/ProductoController.php',
        ]);
    }

    public function gestion(){
        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        //Leo todos los productos
        $productos = $this->getDoctrine()->getRepository(Productos::class)
            ->findAll();

        return $this->render('gestion_productos.html.twig',[
            'categorias'=>$categorias,
            'productos'=>$productos
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

    public function eliminar($id)
    {
        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        //Leo todos los productos
        $producto = $this->getDoctrine()->getRepository(Productos::class)
            ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($producto);
        $entityManager->flush();

        $this->addFlash(
            'productoborrado',
            $producto->getNombre()
        );

        return $this->redirectToRoute('productogestion');
    }

    public function obtenerImagen($nombre_imagen){

        return new Response(@file_get_contents("assets/imagesremeras/$nombre_imagen"));

    }
}
