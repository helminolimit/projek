<?php

namespace App\Controller;

use App\Entity\Bahagian;
use App\Form\BahagianType;
use App\Repository\BahagianRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bahagian')]
class BahagianController extends AbstractController
{
    #[Route('/', name: 'app_bahagian_index', methods: ['GET'])]
    public function index(BahagianRepository $bahagianRepository): Response
    {
        return $this->render('bahagian/index.html.twig', [
            'bahagians' => $bahagianRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bahagian_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BahagianRepository $bahagianRepository): Response
    {
        $bahagian = new Bahagian();
        $form = $this->createForm(BahagianType::class, $bahagian);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bahagianRepository->add($bahagian, true);

            return $this->redirectToRoute('app_bahagian_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bahagian/new.html.twig', [
            'bahagian' => $bahagian,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bahagian_show', methods: ['GET'])]
    public function show(Bahagian $bahagian): Response
    {
        return $this->render('bahagian/show.html.twig', [
            'bahagian' => $bahagian,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bahagian_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bahagian $bahagian, BahagianRepository $bahagianRepository): Response
    {
        $form = $this->createForm(BahagianType::class, $bahagian);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bahagianRepository->add($bahagian, true);

            return $this->redirectToRoute('app_bahagian_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bahagian/edit.html.twig', [
            'bahagian' => $bahagian,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bahagian_delete', methods: ['POST'])]
    public function delete(Request $request, Bahagian $bahagian, BahagianRepository $bahagianRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bahagian->getId(), $request->request->get('_token'))) {
            $bahagianRepository->remove($bahagian, true);
        }

        return $this->redirectToRoute('app_bahagian_index', [], Response::HTTP_SEE_OTHER);
    }
}
