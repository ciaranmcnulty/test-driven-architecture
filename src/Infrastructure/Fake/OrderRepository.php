<?php

namespace Cjm\Delivery\Infrastructure\Fake;

use Cjm\Delivery\Domain\Order;
use Cjm\Delivery\Domain\OrderId;
use Cjm\Delivery\Domain\OrderNotFound;
use Cjm\Delivery\Domain\OrderRepositoryInterface as RepositoryInterface;

class OrderRepository implements RepositoryInterface
{
    /** @var Order[]  */
    private array $orders = [];

    public function add(Order $order): void
    {
        $stringKey = (string)count($this->orders);
        $order->setId($stringKey);

        $this->orders[$stringKey] = clone $order;
    }

    public function get(string $id): Order
    {
        if (array_key_exists($id, $this->orders)) {
            return $this->orders[$id];
        }

        throw new OrderNotFound("Order $id not found");
    }

    public function update(Order $order): void
    {
        $this->orders[$order->getId() ?? ''] = clone $order;
    }
}
