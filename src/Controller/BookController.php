<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('book/add' , name:'book_add')]
    public function addBook(Request $request, ManagerRegistry $manager){
        $book = new Book();
        $form = $this->createForm(BookType::class ,$book);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em = $manager->getManager();
            $em->persist($book);
            $em->flush();
            return new Response('Book added');
        }
        return $this->render('book/book_form.html.twig', [
            'form' => $form
        ]);
    }
}
