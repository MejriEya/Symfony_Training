<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/second')]

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'service_index')]
    public function index(): Response
    {
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    #[Route('/service/{name}', name: 'service_show')]
    public function showService ($name): Response
    {
        return $this->render('service/showService.html.twig',[
            'name'=> $name
        ]);
    }


}
