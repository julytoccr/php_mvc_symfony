<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Usuarios;
use App\Entity\Categorias;



class UsuarioController extends AbstractController
{
    public function index(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
    }

    public function registro(){
        //Tomo todas la categorias para pasarsela a la vista(menu)
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        return $this->render('usuario_registro.html.twig',[
            'categorias'=>$categorias
        ]);
    }

    public function save(Request $request){

        $salvado="failed";

        $email=$request->request->get('email');
        $password=$request->request->get('password');
        $nombre=$request->request->get('nombre');
        $apellido=$request->request->get('apellidos');

        $usuario=new Usuarios();
        $usuario->setApellidos($apellido);
        $usuario->setEmail($email);
        $usuario->setNombre($nombre);
        $usuario->setPassword(password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($usuario);
        $entityManager->flush();

        $salvado="complete";

        $this->addFlash(
            'register',
            $salvado
        );

        return $this->redirectToRoute('usuarioregistro');
    }

    public function login(Request $request){

        $validado="noOk";

        $email=$request->request->get('email');
        $password=$request->request->get('password');

        $usuario=$this->getDoctrine()->getRepository(Usuarios::class)
            ->validar($email,$password);

        if($usuario){
            $validado="ok";
            $this->get('session')->set('identity',true);
            $this->get('session')->set('usuario',$usuario);
        }

        $this->addFlash(
            'validado',
            $validado
        );

        return $this->redirectToRoute('index');
    }

    public function logout(){
        $this->get('session')->clear();
        $this->addFlash(
            'validado',
            "chau"
        );
        return $this->redirectToRoute('index');
    }

}
