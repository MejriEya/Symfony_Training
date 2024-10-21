<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[route('/first')]
class FirstController extends AbstractController
{
    #[Route('/index', name: 'first_index')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'first_name' => 'Admin',
            'last_name' => 'Eya',
        ]);
    }

    #[Route('/show/{name}' , name: "first_show")]
    public function show($name): Response {
        return $this ->render('first/show.html.twig',[
            'n' => $name,
        ]);
    }
    
    #[Route('/redirect' , name: "first_redirect")]
    public function redirectExample(): Response {
        return $this ->redirectToRoute('first_index');
    }

    #[Route('/redirection', name: 'first_redirection')]
    public function redirect2(): Response
    {
        return $this->redirectToRoute('first_show', [
            'name' => 'link'
        ]);
    }
    #[Route('/{name}')]
    public function showService($name):response
    {
        return $this->render('first/showService.html.twig',[
            'name' =>$name
        ]);
    }
}
