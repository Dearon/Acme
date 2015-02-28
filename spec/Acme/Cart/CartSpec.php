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

    function it_should_be_able_to_restore_a_previous_cart(\Acme\Product\Product $product)
    {
        $product->getId()->willReturn('1');
        $product->getName()->willReturn('Product');
        $product->getPrice()->willReturn(1.00);

        $cart = serialize(array($product));
        $this->beConstructedWith($cart);
        $this->getProducts()->shouldHaveCount(1);
    }

    function it_should_receive_a_single_product(\Acme\Product\Product $product)
    {
        $product->getId()->willReturn('1');
        $product->getName()->willReturn('Product');
        $product->getPrice()->willReturn(1.00);

        $this->addProduct($product);
        $this->getProducts()->shouldHaveCount(1);
    }

    function it_should_receive_multiple_products(\Acme\Product\Product $productOne, \Acme\Product\Product $productTwo)
    {
        $productOne->getId()->willReturn('1');
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn(1.00);

        $productTwo->getId()->willReturn('2');
        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn(1.00);

        $this->addProduct($productOne);
        $this->addProduct($productTwo);
        $this->addProduct($productTwo);
        $this->getProducts()->shouldHaveCount(3);
    }

    function it_should_remove_a_single_product(\Acme\Product\Product $productOne, \Acme\Product\Product $productTwo)
    {
        $productOne->getId()->willReturn('1');
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn(1.00);

        $productTwo->getId()->willReturn('2');
        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn(1.00);

        $this->addProduct($productOne);
        $this->addProduct($productTwo);
        $this->removeProduct($productTwo);
        $this->getProducts()->shouldHaveCount(1);
    }

    function it_should_remove_multiple_products(\Acme\Product\Product $productOne, \Acme\Product\Product $productTwo)
    {
        $productOne->getId()->willReturn('1');
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn(1.00);

        $productTwo->getId()->willReturn('2');
        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn(1.00);

        $this->addProduct($productOne);
        $this->addProduct($productTwo);
        $this->addProduct($productTwo);
        $this->removeProduct($productTwo);
        $this->getProducts()->shouldHaveCount(2);
    }

    function it_should_remove_the_correct_product(\Acme\Product\Product $productOne, \Acme\Product\Product $productTwo)
    {
        $productOne->getId()->willReturn('1');
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn(1.00);

        $productTwo->getId()->willReturn('2');
        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn(1.00);

        $this->addProduct($productOne);
        $this->addProduct($productTwo);
        $this->removeProduct($productOne);

        $this->getProducts()->shouldContain($productTwo);
    }

    function it_should_show_the_total_price(\Acme\Product\Product $productOne, \Acme\Product\Product $productTwo)
    {
        $productOne->getId()->willReturn('1');
        $productOne->getName()->willReturn('Product 1');
        $productOne->getPrice()->willReturn(0.50);

        $productTwo->getId()->willReturn('2');
        $productTwo->getName()->willReturn('Product 2');
        $productTwo->getPrice()->willReturn(5.00);

        $this->addProduct($productOne);
        $this->addProduct($productTwo);
        $this->getPrice()->shouldBe(5.50);
    }
}
