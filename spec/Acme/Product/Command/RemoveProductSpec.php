<?php

namespace spec\Acme\Product\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RemoveProductSpec extends ObjectBehavior
{
    function let(\Acme\Product\Product $product)
    {
        $this->beConstructedWith($product);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\Command\RemoveProduct');
    }

    function it_should_return_a_product()
    {
        $this->getProduct()->shouldHaveType('Acme\Product\Product');
    }
}

