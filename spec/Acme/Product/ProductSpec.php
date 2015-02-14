<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    function let(\Acme\Product\Name $name, \Acme\Product\Price $price)
    {
        $name->getName()->willReturn('Product');
        $price->getPrice()->willReturn(1.00);
        $this->beConstructedWith($name, $price);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\Product');
    }
}
