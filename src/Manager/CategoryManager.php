<?php

namespace App\Manager;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryManager
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function getOneByName(string $name): Category
    {
        $entityManager = $this->em;
        $repository = $entityManager->getRepository(Category::class);
        $category = $repository->findOneBy(['name' => $name]);

        return $category;
    }
}
