<?php

namespace App\Controller;

use App\Entity\Productos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categorias;
use App\Entity\Pedidos;
use App\Entity\Usuarios;
use App\Entity\LineasPedidos;


class PedidoController extends AbstractController
{
    public function hacer(){
        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        return $this->render('hacer_pedido.html.twig',[
            'categorias'=>$categorias
        ]);
    }

    public function add(Request $request){


        //Tomo datos que vienen del form
        $provincia=$request->request->get('provincia');
        $localidad=$request->request->get('localidad');
        $direccion=$request->request->get('direccion');

        //tomo los datos del carrito de la sesion
        $carrito = $this->get('session')->get('carrito');

        //tomo los datos del usuario logueado de la sesion
        $usuario = $this->get('session')->get('usuario');

        //preparo el em para grabar datos en la bd
        $entityManager = $this->getDoctrine()->getManager();

        //creo un pedido nuevo
        $pedido=new Pedidos();
        $pedido->setDireccion($direccion);
        $pedido->setLocalidad($localidad);
        $pedido->setProvincia($provincia);
        //hago una referencia al usuario dueño del pedido
        $usuario_para_pedido = $entityManager->getReference(Usuarios::class, $usuario->getId());
        $pedido->setUsuario($usuario_para_pedido);
        $pedido->setEstado("pendiente pago");
        $fecha = new \DateTime();
        $pedido->setFecha($fecha);

        //grabo el pedido
        $entityManager->persist($pedido);
        $entityManager->flush();

        //obtengo el id del pedido creado
        $id_pedido_generado=$pedido->getId();
        $costo_pedido=0;

        //recorro el carrito y grabo en db los productos para el pedido
        foreach ($carrito as $producto_en_carrito){
            //creo un producto de pedido
            $producto_pedido=new LineasPedidos();
            $producto_pedido->setPedido($pedido);

            //hago una referencia el pedido al que pertenece este producto de pedido
            $id_producto = $entityManager->getReference(Productos::class, $producto_en_carrito['id_producto']);


            $producto_pedido->setProducto($id_producto);
            $producto_pedido->setUnidades($producto_en_carrito['unidades']);

            //grabo en bd
            $entityManager->persist($producto_pedido);
            $entityManager->flush();

            //voy calculando el costo total del pedido
            $costo_pedido+=$producto_en_carrito['precio']*$producto_en_carrito['unidades'];
        }

        //actualizo el costo del pedido
        $pedido->setCoste($costo_pedido);

        //grabo la modificacion del costo
        $entityManager->persist($pedido);
        $entityManager->flush();

        return $this->redirectToRoute('pedido_confirmado',['id' => $id_pedido_generado]);
    }

    public function confirmado($id){
        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        $pedido=$this->getDoctrine()->getRepository(Pedidos::class)->find($id);

        $productos_en_pedido=$this->getDoctrine()->getRepository(LineasPedidos::class)
            ->findBy(['pedido'=>$pedido->getId()]);

        return $this->render('pedido_confirmado.html.twig',[
            'categorias'=>$categorias,
            'pedido'=>$pedido,
            'productos_en_pedido'=>$productos_en_pedido
        ]);
    }


    public function mis_pedidos(){

        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        //Busco el usuario que esta logueado para tomar sus pedidos
        $usuario=$this->getDoctrine()->getRepository(Usuarios::class)
            ->find($this->get('session')->get('usuario')->getId());

        //Paso datos a vista y renderizo
        return $this->render('gestion_pedidos.html.twig',[
            'categorias'=>$categorias,
            'pedidos'=>$usuario->getPedidos(),
        ]);
    }


    public function detalle(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PedidoController.php',
        ]);
    }

    public function gestion(){
        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        //Busco el usuario que esta logueado para tomar sus pedidos
        $usuario=$this->getDoctrine()->getRepository(Usuarios::class)
            ->find($this->get('session')->get('usuario')->getId());

        //Paso datos a vista y renderizo
        return $this->render('gestion_pedidos.html.twig',[
            'categorias'=>$categorias,
            'pedidos'=>$usuario->getPedidos(),
        ]);
    }

    public function estado(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PedidoController.php',
        ]);
    }

}
