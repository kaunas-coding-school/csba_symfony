<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TodoItemsController
{
    /**
     * @Route("/todo-items")
     */
    public function list()
    {
        return new Response('Sarasas');
    }

    /**
     * @Route("/todo-item/{id}", methods={"GET"})
     */
    public function show(int $id)
    {
        return new Response('Vienas itemas' . $id);
    }

    /**
     * @Route("/todo-item/{id}", methods={"DELETE"})
     */
    public function delete(int $id)
    {
        return new Response('Salinamas itemas' . $id);
    }

    /**
     * @Route("/todo-item/{id}", methods={"PUT"})
     */
    public function update(int $id, Request $request)
    {
        $data = json_decode($request->getContent(), true);
        return new Response('Atnaujinamas itemas' . $id . implode(' | ', $data));
    }

    /**
     * @Route("/todo-item", methods={"POST"})
     */
    public function store(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        return new Response('Kuriamas itemas' . implode(' | ', $data));
    }
}
