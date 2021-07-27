<?php

namespace App\Service;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\Security\Core\Security;

class Cart
{
    public function __construct(private OrderRepository $repository, private Security $security)
    {
    }

    public function getUserCart(): Order
    {
        $user = $this->security->getUser();
        return $this->repository->findOneBy(['status' => Order::STATUS_CART, 'user' => $user]);
    }
}
