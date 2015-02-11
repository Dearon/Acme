<?php

namespace Acme\Model;

class Product
{
    private $name;
    private $price;

    public function __construct($name, $price)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('The name argument is required');
        }

        if (empty($price)) {
            throw new \InvalidArgumentException('The price argument is required');
        }

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