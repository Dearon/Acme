<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NameSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Product 1', 'product-1');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\Name');
    }

    function it_needs_a_name()
    {
        $this->shouldThrow(new \InvalidArgumentException('The name is required'))->during('__construct', array('', 'product-1'));
    }

    function it_should_not_allow_a_integer_for_the_name()
    {
        $this->shouldThrow(new \InvalidArgumentException('The name has to be a string'))->during('__construct', array(1, 'product-1'));
    }

    function it_should_show_a_name()
    {
        $this->getName()->shouldBe('Product 1');
    }

    function it_needs_a_slug()
    {
        $this->shouldThrow(new \InvalidArgumentException('The slug is required'))->during('__construct', array('Product 1', ''));
    }

    function it_should_not_allow_a_integer_for_the_slug()
    {
        $this->shouldThrow(new \InvalidArgumentException('The slug has to be a string'))->during('__construct', array('Product 1', 1));
    }

    function it_should_show_a_slug()
    {
        $this->getSlug()->shouldBe('product-1');
    }
}
