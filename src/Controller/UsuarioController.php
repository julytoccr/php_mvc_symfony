<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Usuarios;



class UsuarioController extends AbstractController
{
    public function index(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
    }

    public function registro(){
        return $this->json([
            'message' => 'registro to your new controller!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
    }

    public function save(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UsuarioController.php',
        ]);
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
        return $this->redirectToRoute('index');
    }

}
