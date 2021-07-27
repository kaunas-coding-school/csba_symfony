<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class CategoryList
{
    public function __construct(private CategoryRepository $repository)
    {
    }

    public function getMeniuList()
    {
        return $this->repository->findAll();
    }
}
