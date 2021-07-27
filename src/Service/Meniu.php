<?php

namespace App\Service;

use App\Repository\MeniuRepository;

class Meniu
{
    public function __construct(private MeniuRepository $meniuRepository)
    {
    }

    public function getMeniuList()
    {
        return $this->meniuRepository->findAll();
    }
}
