<?php

namespace Acme\Product;

use League\Tactician\Command;

class RemoveProductCommand implements Command
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
