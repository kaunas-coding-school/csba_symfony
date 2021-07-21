<?php

namespace App\Controller;

use App\Entity\TodoItem;
use App\Form\TodoItemType;
use App\Repository\TodoItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Manager\TodoItemManager;

#[Route('/todo/item')]
class TodoItemController extends AbstractController
{
    public function __construct(private TodoItemManager $manager)
    {
    }

    #[Route('/', name: 'todo_item_index', methods: ['GET'])]
    public function index(TodoItemRepository $todoItemRepository): Response
    {
        return $this->render('todo_item/index.html.twig', [
            'todo_items' => $todoItemRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'todo_item_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $todoItem = new TodoItem();
        $form = $this->createForm(TodoItemType::class, $todoItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->store($todoItem);

            return $this->redirectToRoute('todo_item_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('todo_item/new.html.twig', [
            'todo_item' => $todoItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'todo_item_show', methods: ['GET'])]
    public function show(TodoItem $todoItem): Response
    {
        return $this->render('todo_item/show.html.twig', [
            'todo_item' => $todoItem,
        ]);
    }

    #[Route('/{id}/edit', name: 'todo_item_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TodoItem $todoItem): Response
    {
        $form = $this->createForm(TodoItemType::class, $todoItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('todo_item_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('todo_item/edit.html.twig', [
            'todo_item' => $todoItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'todo_item_delete', methods: ['POST'])]
    public function delete(Request $request, TodoItem $todoItem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$todoItem->getId(), $request->request->get('_token'))) {
            $this->manager->delete($todoItem);
        }

        return $this->redirectToRoute('todo_item_index', [], Response::HTTP_SEE_OTHER);
    }
}
