<?php

namespace Acme\Cart;

class Cart
{
    private $products = array();

    public function __construct($products = null)
    {
        if ($products) {
            $this->products = unserialize($products);
        }
    }

    public function addProduct(\Acme\Product\Product $product)
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function removeProduct(\Acme\Product\Product $product)
    {
        foreach($this->products as $key => $value) {
            if ($value->getId() === $product->getId()) {
                unset($this->products[$key]);
                break;
            }
        }
    }

    public function getPrice()
    {
        return array_reduce($this->products, function($carry, $product) {
            return $carry + $product->getPrice();
        }, 0);
    }
}
