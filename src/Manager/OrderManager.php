<?php

namespace App\Manager;

use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Product;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class OrderManager
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function getOldOrders(int $period)
    {
        $date = (new DateTime())->modify("-$period day");
        return $this->em->getRepository(Order::class)
            ->createQueryBuilder('o')
            ->where('o.status = :st AND o.updated_at <= :period')
            ->setParameter('st', Order::STATUS_DONE)
            ->setParameter('period', $date)
            ->getQuery()
            ->getResult();
    }

    public function archiveOrders(array $orders)
    {
        /** @var Order $order */
        foreach ($orders as $order) {
            $order->setStatus(Order::STATUS_ARCHIVE);
            $order->setUpdatedAt(new \DateTimeImmutable());
            $this->em->flush();
        }
    }

}
