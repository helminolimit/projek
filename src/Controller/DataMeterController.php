<?php

namespace App\Controller;

use App\Entity\DataMeter;
use App\Form\DataMeterType;
use App\Repository\DataMeterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/data/meter')]
class DataMeterController extends AbstractController
{
    #[Route('/', name: 'app_data_meter_index', methods: ['GET'])]
    public function index(DataMeterRepository $dataMeterRepository): Response
    {
        return $this->render('data_meter/index.html.twig', [
            'data_meters' => $dataMeterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_data_meter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DataMeterRepository $dataMeterRepository): Response
    {
        $dataMeter = new DataMeter();
        $form = $this->createForm(DataMeterType::class, $dataMeter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dataMeterRepository->add($dataMeter, true);

            return $this->redirectToRoute('app_data_meter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('data_meter/new.html.twig', [
            'data_meter' => $dataMeter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_data_meter_show', methods: ['GET'])]
    public function show(DataMeter $dataMeter): Response
    {
        return $this->render('data_meter/show.html.twig', [
            'data_meter' => $dataMeter,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_data_meter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DataMeter $dataMeter, DataMeterRepository $dataMeterRepository): Response
    {
        $form = $this->createForm(DataMeterType::class, $dataMeter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dataMeterRepository->add($dataMeter, true);

            return $this->redirectToRoute('app_data_meter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('data_meter/edit.html.twig', [
            'data_meter' => $dataMeter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_data_meter_delete', methods: ['POST'])]
    public function delete(Request $request, DataMeter $dataMeter, DataMeterRepository $dataMeterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dataMeter->getId(), $request->request->get('_token'))) {
            $dataMeterRepository->remove($dataMeter, true);
        }

        return $this->redirectToRoute('app_data_meter_index', [], Response::HTTP_SEE_OTHER);
    }
}
