<?php

namespace Acme;

class ProductRepository
{

    public function find($name)
    {
        return array(
            "name" => $name
        );
    }
}
