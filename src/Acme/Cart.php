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
}
