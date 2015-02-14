<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NameSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Product');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\Name');
    }

    function it_needs_a_name()
    {
        $this->shouldThrow(new \InvalidArgumentException('The name is required'))->during('__construct', array(''));
    }

    function it_should_not_allow_a_integer_for_the_name()
    {
        $this->shouldThrow(new \InvalidArgumentException('The name has to be a string'))->during('__construct', array(1));
    }

    function it_should_show_a_name()
    {
        $this->getName()->shouldBe('Product');
    }
}
