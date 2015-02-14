<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\ProductRepository');
    }
}
