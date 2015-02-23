<?php

namespace Acme\Product;

use League\Tactician\Command;

class EditProductCommand implements Command
{
    private $product;
    private $name;
    private $price;
    private $description;

    public function __construct(\Acme\Product\Product $product, $name = null, $price = null, $description = null)
    {
        $this->product = $product;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
