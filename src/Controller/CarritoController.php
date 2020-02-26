<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Categorias;
use App\Entity\Productos;

class CarritoController extends AbstractController
{
    public function index(){

        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        $carrito = $this->get('session')->get('carrito');

        //renderizo la vista y devuelvo
        return $this->render('lista_carrito.html.twig',[
            'categorias'=>$categorias,
            'carrito'=>$carrito
        ]);

    }

    public function add($id){
        $producto_id = $id;

        $session = new Session();

        //Existre el carrito?
        if($session->get('carrito')){
            $carrito=$session->get('carrito');
            $counter = 0;
            foreach($carrito as $indice => $elemento){
                if($elemento['id_producto'] == $producto_id){
                    $carrito[$indice]['unidades']++;
                    $counter++;
                }
            }
        }
        else{
            $carrito=array();
        }
        if(!isset($counter) || $counter == 0){
            // Conseguir datos producto a agregar a carrito
            $producto = $this->getDoctrine()->getRepository(Productos::class)
                ->find($id);

            // Añadir al carrito
            if(is_object($producto)){
                $producto_a_agregar=array(
                    'id_producto' => $producto->getId(),
                    'precio' => $producto->getPrecio(),
                    'unidades' => 1,
                    'imagen' =>$producto->getImagen(),
                    'id' =>$producto->getId(),
                    'nombre' =>$producto->getNombre()
                );
                $carrito[]=$producto_a_agregar;
            }
        }
        $session->set('carrito', $carrito);
        return $this->redirectToRoute('carritoindex');
    }

    public function delete($indice_en_carrito){

        $carrito = $this->get('session')->get('carrito');
        unset($carrito[$indice_en_carrito]);
        $this->get('session')->set('carrito',$carrito);
        return $this->redirectToRoute('carritoindex');
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
        $this->get('session')->clear();
        return $this->redirectToRoute('index');
    }

}
