<?php

namespace Cjm\Delivery\Application;

use Cjm\Delivery\Domain\ItemId;
use Cjm\Delivery\Domain\Order;
use Cjm\Delivery\Domain\OrderId;
use Cjm\Delivery\Domain\OrderRepositoryInterface;

class OrdersService
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    ){}

    public function createNew() : string
    {
        $order = new Order();
        $this->orderRepository->add($order);

        assert(!is_null($order->getId()));

        return $order->getId() ?? '';
    }

    public function addItem(string $orderId, string $itemId) : void
    {
        $order = $this->orderRepository->get($orderId);

        $order->add($itemId);

        $this->orderRepository->update($order);
    }

    /**
     * @return array<array{item:string, quantity:int}>
     */
    public function listItems(string $orderId) : array
    {
        $order = $this->orderRepository->get($orderId);

        $items = [];
        foreach($order->getItems() as $item => $quantity)
        {
            $items[] = ['item' => $item, 'quantity' => $quantity];
        }

        return $items;
    }
}
