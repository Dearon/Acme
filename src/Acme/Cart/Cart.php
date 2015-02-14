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
        foreach($this->products as $productKey => $productValue)
        {
            if ($productValue === $product) {
                unset($this->products[$productKey]);
            }
        }
    }

    public function getPrice()
    {
        $total = 0;
        foreach($this->products as $product)
        {
            $total += $product->getPrice();
        }

        return $total;
    }
}
