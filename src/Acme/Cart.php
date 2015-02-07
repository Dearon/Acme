<?php

namespace Acme;

class Cart
{
    private $products = array();

    public function add($product)
    {
        $this->products[] = $product;
    }

    public function get()
    {
        return $this->products;
    }

    public function remove($product)
    {
        foreach($this->products as $productKey => $productValue)
        {
            if ($productValue === $product) {
                unset($this->products[$productKey]);
            }
        }
    }
}
