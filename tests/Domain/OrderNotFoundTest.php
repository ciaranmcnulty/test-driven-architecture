<?php

namespace Cjm\Delivery\Domain;

use PHPUnit\Framework\TestCase;

class OrderNotFoundTest extends TestCase
{
    /** @test */
    function it_is_an_exception()
    {
        $this->assertInstanceOf(\Throwable::class, new OrderNotFound());
    }
}
