<?php

namespace App\Controller;

use App\Entity\Cuti;
use App\Form\CutiType;
use App\Repository\CutiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cuti')]
class CutiController extends AbstractController
{
    #[Route('/', name: 'app_cuti_index', methods: ['GET'])]
    public function index(CutiRepository $cutiRepository): Response
    {
        return $this->render('cuti/index.html.twig', [
            'cutis' => $cutiRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cuti_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CutiRepository $cutiRepository): Response
    {
        $cuti = new Cuti();
        $form = $this->createForm(CutiType::class, $cuti);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cutiRepository->add($cuti, true);

            return $this->redirectToRoute('app_cuti_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cuti/new.html.twig', [
            'cuti' => $cuti,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cuti_show', methods: ['GET'])]
    public function show(Cuti $cuti): Response
    {
        return $this->render('cuti/show.html.twig', [
            'cuti' => $cuti,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cuti_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cuti $cuti, CutiRepository $cutiRepository): Response
    {
        $form = $this->createForm(CutiType::class, $cuti);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cutiRepository->add($cuti, true);

            return $this->redirectToRoute('app_cuti_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cuti/edit.html.twig', [
            'cuti' => $cuti,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cuti_delete', methods: ['POST'])]
    public function delete(Request $request, Cuti $cuti, CutiRepository $cutiRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cuti->getId(), $request->request->get('_token'))) {
            $cutiRepository->remove($cuti, true);
        }

        return $this->redirectToRoute('app_cuti_index', [], Response::HTTP_SEE_OTHER);
    }
}
