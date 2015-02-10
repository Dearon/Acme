<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Acme\ProductRepository;

class CartSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Cart');
    }

    function it_can_receive_a_single_product($product)
    {
        $product->beADoubleOf('Acme\Model\Product');
        $product->getName()->willReturn('Product');
        $product->getPrice()->willReturn('1.00');

        $this->add($product);
        $this->get()->shouldHaveCount(1);
    }

    function it_can_receive_multiple_products($productOne, $productTwo)
    {
        $productOne->beADoubleOf('Acme\Model\Product');
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn('1.00');

        $productTwo->beADoubleOf('Acme\Model\Product');
        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn('1.00');

        $this->add($productOne);
        $this->add($productTwo);
        $this->get()->shouldHaveCount(2);
    }

    function it_can_remove_a_product($productOne, $productTwo, $productThree)
    {
        $productOne->beADoubleOf('Acme\Model\Product');
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn('1.00');

        $productTwo->beADoubleOf('Acme\Model\Product');
        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn('1.00');

        $productThree->beADoubleOf('Acme\Model\Product');
        $productThree->getName()->willReturn('Product 3');
        $productThree->getPrice()->willReturn('1.00');

        $this->add($productOne);
        $this->add($productTwo);
        $this->add($productThree);
        $this->remove($productTwo);
        $this->get()->shouldHaveCount(2);
    }

    function it_can_show_the_total_price($productOne, $productTwo)
    {
        $productOne->beADoubleOf('Acme\Model\Product');
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn('0.50');

        $productTwo->beADoubleOf('Acme\Model\Product');
        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn('5.00');

        $this->add($productOne);
        $this->add($productTwo);
        $this->getPrice()->shouldBe(5.50);
    }
}
