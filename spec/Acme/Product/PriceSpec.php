<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PriceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(1.00);
        $this->shouldHaveType('Acme\Product\Price');
    }

    function it_needs_a_price()
    {
        $this->shouldThrow(new \InvalidArgumentException('The price is required'))->during('__construct', array(''));
    }

    function it_should_not_allow_a_string()
    {
        $this->shouldThrow(new \InvalidArgumentException('The price has to be a double'))->during('__construct', array('1.00'));
    }

    function it_should_allow_a_double()
    {
        $this->beConstructedWith(1.00);
        $this->getPrice()->shouldBe(1.00);
    }

    function it_should_allow_a_integer()
    {
        $this->beConstructedWith(1);
        $this->getPrice()->shouldBe(1.00);
    }

    function it_should_not_allow_a_negative_doube_for_the_price()
    {
        $this->shouldThrow(new \InvalidArgumentException('The price has to be a positive number'))->during('__construct', array(-1.23));
    }

    function it_should_not_allow_a_negative_integer_for_the_price()
    {
        $this->shouldThrow(new \InvalidArgumentException('The price has to be a positive number'))->during('__construct', array(-1));
    }

    function it_should_handle__double_rounding()
    {
        $this->beConstructedWith(1.499);
        $this->getPrice()->shouldBe(1.50);
    }

    function it_should_handle_integer_rounding()
    {
        $this->beConstructedWith(1);
        $this->getPrice()->shouldBe(1.00);
    }
}
