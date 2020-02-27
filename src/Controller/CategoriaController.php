<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorias;
use App\Entity\Productos;


class CategoriaController extends AbstractController
{
    public function index(){
        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)
            ->findAll();

        return $this->render('listado_categorias.html.twig',[
            'categorias'=>$categorias
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

            //Tomo todas la categorias para pasarsela a la vista(menu)
            $categorias = $this->getDoctrine()->getRepository(Categorias::class)
                ->findAll();

            return $this->render('crear_categoria.html.twig',[
                'categorias'=>$categorias
            ]);

    }

    public function save(Request $request){

        $nombre=$request->request->get('nombre');

        $categoria=new Categorias();
        $categoria->setNombre($nombre);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($categoria);
        $entityManager->flush();

        $salvado="complete";

        $this->addFlash(
            'altacategoria',
            1
        );

        return $this->redirectToRoute('categoriaindex');
    }



}
