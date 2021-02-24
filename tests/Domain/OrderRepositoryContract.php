<?php

namespace Cjm\Delivery\Domain;

use Cjm\Delivery\Domain\OrderRepositoryInterface;
use Cjm\Delivery\Infrastructure\Fake\OrderRepository;

trait OrderRepositoryContract
{
    private OrderRepositoryInterface $repository;

    /**
     * Do whatever is needed to reset this database and cause a new fetch
     */
    function reset()
    {
    }

    /** @test */
    function it_gives_an_id_to_an_order()
    {
        $order = new Order();

        $this->repository->add($order);

        $this->assertNotNull($order->getId());
    }

    /** @test */
    function it_throws_when_getting_order_that_does_not_exist()
    {
        $this->expectException(OrderNotFound::class);

        $this->repository->get('NOT-EXISTS');
    }

    /** @test */
    function it_finds_an_order_that_was_saved()
    {
        $order = new Order();
        $order->add('123');

        $this->repository->add($order);

        $this->reset();
        $order2 = $this->repository->get($order->getId());
        $this->assertEquals($order->getItems(), $order2->getItems());
    }

    /** @test */
    function it_modifies_an_order_that_is_updated()
    {
        $order = new Order();
        $this->repository->add($order);
        $order->add('123');

        $this->repository->update($order);

        $this->reset();
        $order2 = $this->repository->get($order->getId());
        $this->assertEquals($order, $order2);
    }
}
