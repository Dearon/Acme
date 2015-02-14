<?php

namespace Acme\Cart;

class Cart
{
    private $products = array();

    public function add(\Acme\Product\Product $product)
    {
        $this->products[] = $product;
    }

    public function get()
    {
        return $this->products;
    }

    public function remove(\Acme\Product\Product $product)
    {
        $key = array_search($product, $this->products);

        if ($key) {
            unset($this->products[$key]);
        }
    }

    public function getPrice()
    {
        return array_reduce($this->products, function($carry, $product) {
            return $carry + $product->getPrice();
        }, 0);
    }
}
