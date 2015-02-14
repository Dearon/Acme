<?php

namespace spec\Acme\Cart;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CartSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Cart\Cart');
    }

    function it_can_receive_a_single_product(\Acme\Product\Product $product)
    {
        $product->getName()->willReturn('Product');
        $product->getPrice()->willReturn(1.00);

        $this->add($product);
        $this->get()->shouldHaveCount(1);
    }

    function it_can_receive_multiple_products(\Acme\Product\Product $productOne, \Acme\Product\Product $productTwo)
    {
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn(1.00);

        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn(1.00);

        $this->add($productOne);
        $this->add($productTwo);
        $this->add($productTwo);
        $this->get()->shouldHaveCount(3);
    }

    function it_can_remove_a_single_product(\Acme\Product\Product $productOne, \Acme\Product\Product $productTwo)
    {
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn(1.00);

        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn(1.00);

        $this->add($productOne);
        $this->add($productTwo);
        $this->remove($productTwo);
        $this->get()->shouldHaveCount(1);
    }

    function it_can_remove_multiple_products(\Acme\Product\Product $productOne, \Acme\Product\Product $productTwo)
    {
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn(1.00);

        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn(1.00);

        $this->add($productOne);
        $this->add($productTwo);
        $this->add($productTwo);
        $this->remove($productTwo);
        $this->get()->shouldHaveCount(2);
    }

    function it_can_remove_the_correct_product(\Acme\Product\Product $productOne, \Acme\Product\Product $productTwo)
    {
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn(1.00);

        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn(1.00);

        $this->add($productOne);
        $this->add($productTwo);
        $this->remove($productOne);

        $this->get()->shouldContain($productTwo);
    }

    function it_can_show_the_total_price(\Acme\Product\Product $productOne, \Acme\Product\Product $productTwo)
    {
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn(0.50);

        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn(5.00);

        $this->add($productOne);
        $this->add($productTwo);
        $this->getPrice()->shouldBe(5.50);
    }
}
