<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    function let(\Acme\Product\Name $name, \Acme\Product\Price $price, \Acme\Product\Description $description)
    {
        $name->getName()->willReturn('Product');
        $name->getSlug()->willReturn('product');
        $price->getPrice()->willReturn(1.00);
        $description->getDescription()->willReturn('A description');
        $this->beConstructedWith($name, $price, $description);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\Product');
    }

    function it_should_show_a_name()
    {
        $this->getName()->shouldBe('Product');
    }

    function it_should_show_a_slug()
    {
        $this->getSlug()->shouldBe('product');
    }

    function it_should_show_a_price()
    {
        $this->getPrice()->shouldBe(1.00);
    }

    function it_should_show_a_description()
    {
        $this->getDescription()->shouldBe('A description');
    }
}
