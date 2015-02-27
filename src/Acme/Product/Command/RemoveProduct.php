<?php

namespace Acme\Product\Command;

class RemoveProduct implements \League\Tactician\Command
{
    private $product;

    public function __construct(\Acme\Product\Product $product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }
}
