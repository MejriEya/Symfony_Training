<?php

namespace App\Controller;

use App\Form\ClientType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CompteController extends AbstractController
{
    #[Route('/compte', name: 'app_compte')]
    public function index(): Response
    {
        return $this->render('compte/index.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }


    #[Route ('/CompteForm',name:"CompteForm")]
    public function addClient(ManagerRegistry $mgr , Request $request ): Response{
        
        $Client = new Client);
        $form = $this->createForm(ClientType::class,$Client);
    

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $mgr->getManager();
            $em->persist($Client);
            $em->flush();

            return $this->redirectToRoute('app_client');
        }
    return $this->render('client/form.html.twig',[
       "form" => $form->createView()
      ]);
    }
}
