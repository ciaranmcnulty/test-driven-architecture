<?php

namespace Cjm\Delivery\Infrastructure\Doctrine;

use Cjm\Delivery\Domain\OrderRepositoryContract;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderRepositoryTest extends KernelTestCase
{
    use OrderRepositoryContract;

    private ?EntityManagerInterface $entityManager;

    function reset()
    {
        $this->entityManager->clear();
    }

    function setUp(): void
    {
        self::bootKernel();
        $container = (self::$container)->get('test.service_container');

        $this->repository = $container->get(OrderRepository::class);
        $this->entityManager = $container->get(EntityManagerInterface::class);
    }

    function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
