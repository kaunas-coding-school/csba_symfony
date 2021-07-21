<?php

namespace App\Manager;

use App\Entity\TodoItem;
use Doctrine\ORM\EntityManagerInterface;

class TodoItemManager
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function store(TodoItem $todoItem): void
    {
        $this->em->persist($todoItem);
        $this->em->flush();
    }

    public function delete(TodoItem $todoItem): void
    {
        $this->em->remove($todoItem);
        $this->em->flush();
    }
}
