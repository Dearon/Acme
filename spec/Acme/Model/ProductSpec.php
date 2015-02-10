<?php

namespace spec\Acme\Model;

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
        $this->shouldHaveType('Acme\Model\Product');
    }
}
