<?php

namespace Application;

use Cjm\Delivery\Application\OrdersService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrdersServiceTest extends KernelTestCase
{
    private OrdersService $orders;

    function setUp(): void
    {
        self::bootKernel();
        $container = (self::$container)->get('test.service_container');

        $this->orders = $container->get(OrdersService::class);
    }

    /** @test */
    function it_can_add_to_an_empty_order()
    {
        $orderId = $this->orders->createNew();

        $this->orders->addItem($orderId, 'CHEESEBURGER');
        $actual = $this->orders->listItems($orderId);

        $expected = [
            ['item' => 'CHEESEBURGER', 'quantity' => 1]
        ];
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    function it_can_aggregate_quantities_of_items()
    {
        $this->orderId = $this->orders->createNew();
        $this->orders->addItem($this->orderId, 'CHEESEBURGER');
        $this->orders->addItem($this->orderId, 'FRIES');
        $this->orders->addItem($this->orderId, 'FRIES');

        $actual = $this->orders->listItems($this->orderId);

        $expected = [
            ['item' => 'CHEESEBURGER', 'quantity' => 1],
            ['item' => 'FRIES', 'quantity' => 2]
        ];
        $this->assertEquals($expected, $actual);
    }
}
