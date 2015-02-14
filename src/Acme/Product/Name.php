<?php

namespace Acme\Product;

class Name
{
    private $name;

    public function __construct($name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('The name is required');
        }

        if (gettype($name) != "string") {
            throw new \InvalidArgumentException('The name has to be a string');
        }

        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
