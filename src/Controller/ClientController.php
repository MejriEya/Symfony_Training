<?php

namespace App\Controller;


use App\Entity\Client;
use App\Form\ClientType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'app_client')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    #[Route('/listcLient' ,name:'client_list') ]
    public function listDB (ManagerRegistry $doctrine):Response
    {
        $repo=$doctrine->getRepository(Client::class);
        $list=$repo->findAll();
        return $this->render('client/list.html.twig',[
            'list'=>$list,
        ]);
    }

    //#[Route ('/addClient' ,name:"addClient")]
    //public function Add(ManagerRegistry $em):Response {
      //  $manager = $em->getManager();
      //  $client = new Client();
     //   $manager-> persist($client);//insert 
      //  $manager -> flush();//ajout dans la base de donnée 
      //  return new Response("Client added successfully");
   // }


    #[Route ('/clientform',name:"formClient")]
    public function addClient(ManagerRegistry $mgr , Request $request ): Response{
        
        $Client = new Client();
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
