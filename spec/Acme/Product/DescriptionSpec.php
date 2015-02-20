<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DescriptionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Description text');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\Description');
    }

    function it_needs_a_description()
    {
        $this->shouldThrow(new \InvalidArgumentException('The description is required'))->during('__construct', array(''));
    }

    function it_should_not_allow_a_integer_for_the_description()
    {
        $this->shouldThrow(new \InvalidArgumentException('The description has to be a string'))->during('__construct', array(1));
    }

    function it_should_show_a_description()
    {
        $this->getDescription()->shouldBe('Description text');
    }
}
