<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\ProductRepository');
    }

    function it_can_find_a_product()
    {
        $this->find("Product")->shouldReturn(array("name" => "Product"));
    }
}
