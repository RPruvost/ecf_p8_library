<?php

namespace App\Controller;

use App\Entity\Loan;
use App\Form\LoanType;
use App\Repository\LoanRepository;
use App\Repository\BorrowerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface; 

/**
 * @Route("/loan")
 */
class LoanController extends AbstractController
{


    /**
     * @Route("/", name="loan_index", methods={"GET"})
     */
    public function index(LoanRepository $loanRepository, BorrowerRepository $borrowerRepository, Request $request, PaginatorInterface $paginator): Response
    {
            $user = $this->getUser();
            $loans = $loanRepository->findAll();
            // Récupération du compte de l'utilisateur qui est connecté
            // On vérifie si l'utilisateur est un emprunteur 
            if ($this->isGranted('ROLE_BORROWER')) {
                // Récupèration du profil emprunteur
                $borrower = $borrowerRepository->findOneByUser($user);
                $loans = $borrower->getLoans();

                return $this->render('loan/index.html.twig', [
                    'loans' => $loans,
                ]);
            } elseif ($this->isGranted('ROLE_ADMIN')) {
                $data = $this->getDoctrine()->getRepository(Loan::class)->findBy([],['id' => 'ASC']);

                $loan = $paginator->paginate(
                    $data, 
                    $request->query->getInt('page', 1), 
                    15 
                );

                return $this->render('loan/index.html.twig', [
                    'loans' => $loan,
                ]);
            }
    } 

    /**
     * @Route("/new", name="loan_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $loan = new Loan();
        $form = $this->createForm(LoanType::class, $loan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($loan);
            $entityManager->flush();

            return $this->redirectToRoute('loan_index');
        }

        return $this->render('loan/new.html.twig', [
            'loan' => $loan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="loan_show", methods={"GET"})
     */
    public function show(Loan $loan): Response
    {
        return $this->render('loan/show.html.twig', [
            'loan' => $loan,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="loan_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Loan $loan): Response
    {
        $form = $this->createForm(LoanType::class, $loan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('loan_index');
        }

        return $this->render('loan/edit.html.twig', [
            'loan' => $loan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="loan_delete", methods={"POST"})
     */
    public function delete(Request $request, Loan $loan): Response
    {
        if ($this->isCsrfTokenValid('delete'.$loan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($loan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('loan_index');
    }
}