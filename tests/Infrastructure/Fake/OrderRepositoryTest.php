<?php

namespace Cjm\Delivery\Infrastructure\Fake;

use Cjm\Delivery\Domain\OrderRepositoryContract;
use PHPUnit\Framework\TestCase;

class OrderRepositoryTest extends TestCase
{
    use OrderRepositoryContract;

    function setUp(): void
    {
        $this->repository = new OrderRepository();
    }
}
