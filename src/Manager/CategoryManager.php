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
        return $this->em->getRepository(Category::class)
            ->findOneBy(['name' => $name])
            ;
    }
}
