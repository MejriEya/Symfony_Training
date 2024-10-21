<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/show/{name}' , name: 'author_show')]
    public function showAuthor($name): Response{
        return $this-> render('author/show.html.twig',
         [
            "name"=> $name
         ]);
    }

    #[Route('/list' , name: 'author_list')]
    public function listAuthors(): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/image1.jfif','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/image2.jfif','username' => ' William Shakespeare', 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/image3.jfif','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
            );            
        return $this->render('author/list.html.twig' , [
            'authors' => $authors
        ]);
    }

    #[Route('/list2' ,name:'author_list2') ]
    public function listDB (ManagerRegistry $doctrine):Response
    {
        $repo=$doctrine->getRepository(Author::class);
        $list=$repo->findAll();
        return $this->render('author/list2.html.twig',[
            'list'=>$list,
        ]);
    }
    
    #[Route('/details/{id}' ,name:'author_details')]
    public function details(AuthorRepository $repo,$id):Response {
        $id = $repo->find($id);//liason avec la DB
        return $this->render('author/details.html.twig',[
            'author'=> $id,
        ]);
    }

    #[Route('/details2/{id}', name:'author_details2 ')]
    public function authorDetails2($id): Response {
        return $this->render('author/details2.html.twig', [
            'author'=> $id,
        ]);
    }

    #[Route ('/details3/{id}' ,name:"author_details3")]
    public function details3(Author $author):Response{
        return $this->render('author/details.html.twig',[
            "author"=>$author,
        ]);
    }

    #[Route ('/addAuthorStatic' ,name:"addAuthorStatic")]
    public function Add(ManagerRegistry $em):Response {
        $manager = $em->getManager();
        $author = new Author();
        $author -> setUsername('name');
        $author -> setEmailAdress('name@gmail.com');
        $author -> setNbBooks(28);
        $manager-> persist($author);//insert 
        $manager -> flush();//ajout dans la base de donnée 
        return new Response("author added successfully");
    }

    //#[Route ('/formulaire',name:"formulaire")]
   // public function addAuthor(ManagerRegistry $manager , Request $request ): Response{
    //    $em = $manager->getManager();
    //    $author = new Author();
        //appel au formulaire
    //    $form = $this->createForm(AuthorType:;class,$author);
     //   $form->handleRequest($request);
     //   return $this->render('author/form.html.twig',[
     //       "form" => $form,
      //  ]);
   // }

}
