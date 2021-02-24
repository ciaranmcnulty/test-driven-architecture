<?php

namespace App\Controller;

use Cjm\Delivery\Application\OrdersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name:'order')]
    function menu(OrdersService $ordersService, Request $request): Response
    {
        $orderId = (string) $request->getSession()->get('orderId');

        $order = $orderId ? $ordersService->listItems($orderId) : null;

        return $this->render(
            'order.html.twig',
            [
                'items' => ['CHEESEBURGER', 'FRIES', 'BEANBURGER'],
                'order' => $order
            ]
        );
    }

    #[Route('/add-item', methods: ['POST'])]
    function addItem(OrdersService $ordersService, SessionInterface $session, Request $request): Response
    {
        $itemId = (string)$request->request->get('item');

        if (!$orderId = (string) $session->get('orderId')) {
            $orderId = $ordersService->createNew();
            $session->set('orderId', $orderId);
        }

        $ordersService->addItem($orderId, $itemId);

        return $this->redirectToRoute('order');
    }
}
