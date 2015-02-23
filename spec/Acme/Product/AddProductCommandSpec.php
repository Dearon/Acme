<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddProductCommandSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Name', 1.11, 'Description');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\AddProductCommand');
    }

    function it_should_show_a_name()
    {
        $this->getName()->shouldBe('Name');
    }

    function it_should_show_a_price()
    {
        $this->getPrice()->shouldBe(1.11);

    }

    function it_should_show_a_description()
    {
        $this->getDescription()->shouldBe('Description');
    }
}
