<?php

namespace Cjm\Delivery\Domain;

class Order
{
    private ?string $id = null;

    /** @var array<string, int> */
    private array $items = [];

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function add(string $item): void
    {
        if (!array_key_exists($item, $this->items)) {
            $this->items[$item] = 0;
        }

        $this->items[$item]++;
    }

    /**
     * @return array<string, int>
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
