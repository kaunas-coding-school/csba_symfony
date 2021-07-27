<?php

namespace App\Manager;

use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CartManager
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function addToCart(Product $product, UserInterface $user): Order
    {
        /** @var Order $cart */
        $cart = $this->em->getRepository(Order::class)->findOneBy(['status' => Order::STATUS_CART, 'user' => $user]);
        if (!$cart) {
            $cart = new Order();
            $cart->setStatus(Order::STATUS_CART);
            $cart->setUser($user);
            $this->em->persist($cart);
        }
        $cart->addProduct($product);
        $this->em->flush();

        return $cart;
    }

    public function removeFromCart(Product $product, UserInterface $user): Order
    {
        /** @var Order $cart */
        $cart = $this->em->getRepository(Order::class)->findOneBy(['status' => Order::STATUS_CART, 'user' => $user]);
        if ($cart) {
            $cart->removeProduct($product);
            $this->em->flush();
        }

        return  $cart;
    }
}
