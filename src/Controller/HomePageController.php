<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface; 



/**
 * @Route("/")
 */
class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods={"GET"})
     */
    public function index(BookRepository $bookRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $data = $this->getDoctrine()->getRepository(Book::class)->findBy([],['id' => 'ASC']);

        $book = $paginator->paginate(
            $data, 
            $request->query->getInt('page', 1), 
            15 
        );
        return $this->render('book/index.html.twig', [
            'books' => $book,
        ]);
    }
    
}
