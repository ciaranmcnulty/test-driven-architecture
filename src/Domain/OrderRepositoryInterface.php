<?php

namespace Cjm\Delivery\Domain;

interface OrderRepositoryInterface
{
    public function add(Order $order): void;

    /** @throws OrderNotFound */
    public function get(string $orderId): Order;

    /** @throws OrderNotFound */
    public function update(Order $order): void;
}
