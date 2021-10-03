<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Genre;
use App\Entity\Borrower;
use App\Entity\Loan;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\BorrowerRepository;
use App\Repository\GenreRepository;
use App\Repository\LoanRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(
        AuthorRepository $authorRepository,
        BookRepository $bookRepository,
        BorrowerRepository $borrowerRepository,
        GenreRepository $genreRepository,
        LoanRepository $loanRepository,
        UserRepository $userRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        //User

        //- la liste complète de tous les utilisateurs (de la table `user`)
        // $users = $userRepository->findAll();
        // dump($users);

        //- les données de l'utilisateur dont l'id est `1`
        // $user = $userRepository->find(1);
        // dump($user);

        //- les données de l'utilisateur dont l'email est `foo.foo@example.com`
        // $user = $userRepository->findOneBy(['email'=>'foo.foo@example.com']);
        // dump($user);

        //- les données des utilisateurs dont l'attribut `roles` contient le mot clé `ROLE_EMRUNTEUR`
        // $user = $userRepository->findByRole('ROLE_BORROWER');
        // dump($user);

        //Livres

        //- la liste complète de tous les livres
        // $books = $bookRepository->findAll();
        // dump($books);

        //- les données du livre dont l'id est `1`
        // $book = $bookRepository->find(1);
        // dump($book);

        //- la liste des livres dont le titre contient le mot clé `lorem`
        // $book = $bookRepository->findByTitle('lorem');
        // dump($book);

        //- la liste des livres dont l'id de l'auteur est `2`
        // $book = $bookRepository->findOneByAuthor(2);
        // dump($book);

        //- la liste des livres dont le genre contient le mot clé `roman`
        // $book = $bookRepository->findOneByGenre('roman');
        // dump($book);

        //-ajouter un nouveau livre
        // $genres = $genreRepository->findAll();
        // $book2 = $bookRepository->findAll()[1];
        // $book2->setTitle('Aperiendum est igitur');
        // $book2->addGenre($genres[4]);
        // $entityManager->persist($book2);
        // $entityManager->flush();
        // dump($book2);

        // requête de mise à jour
        // $author = $authorRepository->findAll();
        // $genres = $genreRepository->findAll();
        // $book = new Book();
        // $book->setTitle('Totum autem id externum');
        // $book->setEditionYears('2020');
        // $book->setPagesNumber('300');
        // $book->setCodeIsbn('9790412882714');
        // $book->setAuthor($author[1]);
        // $book->addGenre($genres[5]);
        // $entityManager->flush();

        // requête de suppression 
        //  $deleteBook = $bookRepository->find(123);
        //  $entityManager->remove($deleteBook[0]);
        //  $entityManager->flush();

        //Emprunteurs

        //- la liste complète des emprunteurs
        // $borrowers = $borrowerRepository->findAll();
        // dump($borrowers);

        //- les données de l'emprunteur dont l'id est `3`
        // $borrower = $borrowerRepository->find(3);
        // dump($borrower);

        //- les données de l'emprunteur qui est relié au user dont l'id est `3`
        // $borrower = $borrowerRepository->findOneByUser(3);
        // dump($borrower);

        //- la liste des emprunteurs dont le nom ou le prénom contient le mot clé `foo`
        // $borrower = $borrowerRepository->findOneByName('foo');
        // dump($borrower);

        //- la liste des emprunteurs dont le téléphone contient le mot clé `1234`
        // $borrower = $borrowerRepository->findOneByPhone('1234');
        // dump($borrower);

        //- la liste des emprunteurs dont la date de création est antérieure au 01/03/2021 exclu (c-à-d strictement plus petit)
        // $borrower = $borrowerRepository->findOneByDate('2021-03-01');
        // dump($borrower);

        //- la liste des emprunteurs inactifs (c-à-d dont l'attribut `actif` est égal à `false`)
        // $borrowerOff = $borrowerRepository->findByActive(false);
        // dump($borrowerOff);

        // Les Emprunts

        //- la liste des 10 derniers emprunts au niveau chronologique
        // $loans = $loanRepository->findByLoan();
        // dump($loans);
        // exit();

        //- la liste des emprunts de l'emprunteur dont l'id est `2`
        // $borrower2 = $loanRepository->findByBorrower(2);
        // dump($borrower2);

        //- la liste des emprunts du livre dont l'id est `3`
        // $book3 = $loanRepository->findByBook(3);
        // dump($book3);

        //- la liste des emprunts qui ont été retournés avant le 01/01/2021
        // $loan = $loanRepository->findOneByDate('2021-01-01');
        // dump($loan);

        //- la liste des emprunts qui n'ont pas encore été retournés (c-à-d dont la date de retour est nulle)
        // $loanReturnDate = $loanRepository->findByReturnDate();
        // dump($loanReturnDate);
        

        //- les données de l'emprunt du livre dont l'id est `3` et qui n'a pas encore été retournés (c-à-d dont la date de retour est nulle)
        // $loanIdAndReturnFalse = $loanRepository->findByIdAndReturn(3);
        // dump($loanIdAndReturnFalse);

        
        // $borrowers = $borrowerRepository->findAll();
        // $books = $bookRepository->findAll();

        // - ajouter un nouvel emprunt
        // $newLoan = new Loan();
        // $newLoan->setLoanDate(\DateTime::createFromFormat('Y-m-d H:i:s', '2020-12-01 16:00:00'));
        // $newLoan->setBorrower($borrowers[0]);
        // $newLoan->setBook($books[0]);
        // $entityManager->persist($newLoan);
        // $entityManager->flush();

        //Requêtes de mise à jour :
        // $thirdLoan = $loanRepository->find(3);
        // $thirdLoan->setReturnDate(\DateTime::createFromFormat('Y-m-d H:i:s', '2020-05-01 10:00:00'));
        // $entityManager->persist($thirdLoan);
        // $entityManager->flush();

        //- supprimer l'emprunt dont l'id est `42`
        // $loan = $loanRepository->find(42);
        // $entityManager->remove($loan);
        // $entityManager->flush();

        exit();
    }
}
