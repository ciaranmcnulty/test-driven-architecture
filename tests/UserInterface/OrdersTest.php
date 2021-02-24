<?php


namespace App\Tests\UserInterface;

use Cjm\Delivery\Application\OrdersService;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use function spec\PhpSpec\Factory\validFactory;

class OrdersTest extends WebTestCase
{
    /** @test */
    function it_can_aggregate_quantities_of_items()
    {
        $client = static::createClient();
        $client->followRedirects(true);

        $client->request('GET', '/order');

        $this->addItem('CHEESEBURGER', $client);
        $this->addItem('FRIES', $client);
        $this->addItem('FRIES', $client);

        $this->assertSelectorTextContains('.order', 'CHEESEBURGER X 1');
        $this->assertSelectorTextContains('.order', 'FRIES X 2');
    }

    private function addItem(string $item, KernelBrowser $client): void
    {
        $form = $client->getCrawler()->selectButton($item)->form();
        $client->submit($form, ['item'=>$item]);
    }
}
