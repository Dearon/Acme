<?php

namespace spec\Acme;

use Acme\Model\Product;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CartSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Cart');
    }

    function it_can_receive_a_single_product(\Acme\Model\Product $product)
    {
        $product->getName()->willReturn('Product');
        $product->getPrice()->willReturn('1.00');

        $this->add($product);
        $this->get()->shouldHaveCount(1);
    }

    function it_can_receive_multiple_products(\Acme\Model\Product $productOne, \Acme\Model\Product $productTwo)
    {
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn('1.00');

        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn('1.00');

        $this->add($productOne);
        $this->add($productTwo);
        $this->get()->shouldHaveCount(2);
    }

    function it_can_remove_a_product(\Acme\Model\Product $productOne, \Acme\Model\Product $productTwo, \Acme\Model\Product $productThree)
    {
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn('1.00');

        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn('1.00');

        $productThree->getName()->willReturn('Product 3');
        $productThree->getPrice()->willReturn('1.00');

        $this->add($productOne);
        $this->add($productTwo);
        $this->add($productThree);
        $this->remove($productTwo);
        $this->get()->shouldHaveCount(2);
    }

    function it_can_show_the_total_price(\Acme\Model\Product $productOne, \Acme\Model\Product $productTwo)
    {
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn('0.50');

        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn('5.00');

        $this->add($productOne);
        $this->add($productTwo);
        $this->getPrice()->shouldBe(5.50);
    }
}
