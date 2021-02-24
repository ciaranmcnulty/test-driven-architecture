<?php

namespace Cjm\Delivery\Domain;

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    private Order $order;

    function setUp(): void
    {
        $this->order = new Order();
    }

    /** @test */
    function it_has_a_default_null_identity()
    {
        $this->assertNull($this->order->getId());
    }

    /** @test */
    function it_has_an_identity_when_set()
    {
        $this->order->setId('abc');

        $this->assertEquals('abc', $this->order->getId());
    }

    /** @test */
    function it_can_list_an_item_quantity()
    {
        $this->order->add('FRIES');

        $this->assertEquals(
            [
                'FRIES' => 1
            ],
            $this->order->getItems()
        );
    }

    /** @test */
    function it_can_aggregate_item_quantities()
    {
        $this->order->add('FRIES');
        $this->order->add('FRIES');

        $this->assertEquals(
            [
                'FRIES' => 2
            ],
            $this->order->getItems()
        );
    }

}
