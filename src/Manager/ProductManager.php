<?php

namespace App\Manager;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductManager
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function getByEan(string $ean): ?Product
    {
        return $this->em->getRepository(Product::class)->findOneBy(['ean' => $ean]);
    }

}
