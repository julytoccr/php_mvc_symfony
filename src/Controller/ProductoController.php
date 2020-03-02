<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        return $this->render('edicion_alta_producto.html.twig',[
            'categorias'=>$categorias
        ]);
    }

    public function save($id=0,Request $request){

        $nombre=$request->request->get('nombre');
        $descripcion=$request->request->get('descripcion');
        $precio=$request->request->get('precio');
        $stock=$request->request->get('stock');
        $categoria=$request->request->get('categoria');
        $imagen=$request->request->get('imagen');
        $entityManager = $this->getDoctrine()->getManager();

        if($id){
            //busco el producto a editar
            $producto = $this->getDoctrine()->getRepository(Productos::class)
                ->find($id);
            $this->addFlash(
                'updateproducto',$nombre
            );
            if($imagen){
                $producto->setImagen($imagen);
                //Aca greabo la imagen en dir de imagen

            }
        }
        else{
            //Creo un producto nuevo
            $producto = new Productos();
            $this->addFlash(
                'altaproducto',$nombre
            );
            $fecha = new \DateTime();
            $producto->setFecha($fecha);
            if($imagen){
                $producto->setImagen($imagen);
                //Aca greabo la imagen en dir de imagen
            }
            else{
                //pongo una imagen por defecto
                $producto->setImagen("sin_imagen.jpg");
            }
        }

        $producto->setNombre($nombre);
        $producto->setDescripcion($descripcion);
        $producto->setPrecio($precio);
        $producto->setStock($stock);
        //hago una referencia a categoria para poder usarla
        $categoria = $entityManager->getReference(Categorias::class, $categoria);
        $producto->setCategoria($categoria);

        //grabo producto modificado/agregado
        $entityManager->persist($producto);
        $entityManager->flush();

        return $this->redirectToRoute('productogestion');
    }

    public function editar($id){
        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        //Leo producto a editar
        $producto = $this->getDoctrine()->getRepository(Productos::class)
            ->find($id);

        return $this->render('edicion_alta_producto.html.twig',[
            'categorias'=>$categorias,
            'producto'=>$producto
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
