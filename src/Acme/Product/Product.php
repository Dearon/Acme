<?php

namespace Acme\Product;

class Product
{
    private $name;
    private $price;

    public function __construct(\Acme\Product\Name $name, \Acme\Product\Price $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
