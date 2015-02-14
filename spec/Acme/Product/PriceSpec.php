<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PriceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1.00);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\Price');
    }

    function it_requires_a_price()
    {
        $this->shouldThrow(new \InvalidArgumentException('The price is required'))->during('__construct', array(''));
    }

    function it_requires_a_double_for_the_price()
    {
        $this->shouldThrow(new \InvalidArgumentException('The price has to be a double'))->during('__construct', array('1.00'));
    }

    function it_requires_a_positive_doube_for_the_price()
    {
        $this->shouldThrow(new \InvalidArgumentException('The price has to be a positive number'))->during('__construct', array(-1.23));
    }

    function it_shows_the_price()
    {
        $this->beConstructedWith(1.23);
        $this->getPrice()->shouldBe(1.23);
    }
}
