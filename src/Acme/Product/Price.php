<?php

namespace Acme\Product;

class Price
{
    private $price;

    public function __construct($price)
    {
        if (empty($price)) {
            throw new \InvalidArgumentException('The price is required');
        }

        if (gettype($price) != "double") {
            throw new \InvalidArgumentException('The price has to be a double');
        }

        if ($price < 0.01) {
            throw new \InvalidArgumentException('The price has to be a positive number');
        }

        $this->price = round($price, 2);
    }

    public function getPrice()
    {
        return $this->price;
    }
}
