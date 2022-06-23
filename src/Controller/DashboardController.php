<?php

namespace App\Controller;

use App\Entity\Dashboard;
use App\Form\DashboardType;
use App\Repository\DashboardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard_index', methods: ['GET'])]
    public function index(DashboardRepository $dashboardRepository): Response
    {
        return $this->render('dashboard/content.html.twig', [
            'dashboards' => $dashboardRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dashboard_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DashboardRepository $dashboardRepository): Response
    {
        $dashboard = new Dashboard();
        $form = $this->createForm(DashboardType::class, $dashboard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dashboardRepository->add($dashboard, true);

            return $this->redirectToRoute('app_dashboard_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/new.html.twig', [
            'dashboard' => $dashboard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dashboard_show', methods: ['GET'])]
    public function show(Dashboard $dashboard): Response
    {
        return $this->render('dashboard/show.html.twig', [
            'dashboard' => $dashboard,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dashboard_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dashboard $dashboard, DashboardRepository $dashboardRepository): Response
    {
        $form = $this->createForm(DashboardType::class, $dashboard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dashboardRepository->add($dashboard, true);

            return $this->redirectToRoute('app_dashboard_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/edit.html.twig', [
            'dashboard' => $dashboard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dashboard_delete', methods: ['POST'])]
    public function delete(Request $request, Dashboard $dashboard, DashboardRepository $dashboardRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dashboard->getId(), $request->request->get('_token'))) {
            $dashboardRepository->remove($dashboard, true);
        }

        return $this->redirectToRoute('app_dashboard_index', [], Response::HTTP_SEE_OTHER);
    }
}
