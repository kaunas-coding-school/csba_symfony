<?php

namespace App\Controller;

use App\Entity\Meniu;
use App\Form\MeniuType;
use App\Repository\MeniuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouteCollection;

#[Route('/meniu')]
class MeniuController extends AbstractController
{
    #[Route('/', name: 'meniu_index', methods: ['GET'])]
    public function index(MeniuRepository $meniuRepository): Response
    {
        return $this->render('meniu/index.html.twig', [
            'menius' => $meniuRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'meniu_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $meniu = new Meniu();
        $form = $this->createForm(MeniuType::class, $meniu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($meniu);
            $entityManager->flush();

            return $this->redirectToRoute('meniu_index', [], Response::HTTP_SEE_OTHER);
        }

        $router = $this->get('router');
        /** @var RouteCollection $routes */
        $routes = $router->getRouteCollection();

        return $this->renderForm('meniu/new.html.twig', [
            'meniu' => $meniu,
            'form' => $form,
            'routes' => $routes,
        ]);
    }

    #[Route('/{id}', name: 'meniu_show', methods: ['GET'])]
    public function show(Meniu $meniu): Response
    {
        return $this->render('meniu/show.html.twig', [
            'meniu' => $meniu,
        ]);
    }

    #[Route('/{id}/edit', name: 'meniu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Meniu $meniu): Response
    {
        $form = $this->createForm(MeniuType::class, $meniu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('meniu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('meniu/edit.html.twig', [
            'meniu' => $meniu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'meniu_delete', methods: ['POST'])]
    public function delete(Request $request, Meniu $meniu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$meniu->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($meniu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('meniu_index', [], Response::HTTP_SEE_OTHER);
    }
}
