<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Product', '1.00');
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\Product');
    }

    function it_requires_the_product_field()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('__construct', array('', '1.00'));
    }

    function it_requires_the_price_field()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('__construct', array('Product', ''));
    }
}
