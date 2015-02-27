<?php

namespace spec\Acme\Product\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EditProductSpec extends ObjectBehavior
{
    function let(\Acme\Product\Product $product)
    {
        $this->beConstructedWith($product, 'Name', 1.00, 'Description');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\Command\EditProduct');
    }

    function it_should_show_a_product()
    {
        $this->getProduct()->shouldHaveType('Acme\Product\Product');
    }

    function it_should_show_a_name()
    {
        $this->getName()->shouldBe('Name');
    }

    function it_should_show_a_price()
    {
        $this->getPrice()->shouldBe(1.00);
    }

    function it_should_show_a_description()
    {
        $this->getDescription()->shouldBe('Description');
    }
}
