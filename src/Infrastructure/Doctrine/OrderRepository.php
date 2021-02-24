<?php

namespace Cjm\Delivery\Infrastructure\Doctrine;

use Cjm\Delivery\Domain\Order;
use Cjm\Delivery\Domain\OrderNotFound;
use Cjm\Delivery\Domain\OrderRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ){}

    public function add(Order $order): void
    {
        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }

    /** @throws OrderNotFound */
    public function get(string $orderId): Order
    {
        $order = $this->entityManager
            ->getRepository(Order::class)
            ->findOneBy(['id' => $orderId]);

        if (is_null($order)) {
            throw new OrderNotFound();
        }

        return $order;
    }

    /** @throws OrderNotFound */
    public function update(Order $order): void
    {
        $this->entityManager->flush();
    }
}
