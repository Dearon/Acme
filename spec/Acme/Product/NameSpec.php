<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NameSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Product 1');
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
        $this->getName()->shouldBe('Product 1');
    }

    function it_should_generate_a_slug(\Acme\Product\ProductRepository $productRepository)
    {
        $productRepository->findBySlug('product-1')->willReturn(null);
        $this->generateSlug($productRepository);
        $this->getSlug()->shouldBe('product-1');
    }

    function it_should_not_generate_a_duplicate_slug(\Acme\Product\ProductRepository $productRepository)
    {
        $productRepository->findBySlug('product-1')->willReturn(true);
        $productRepository->findBySlug('product-1-1')->willReturn(null);
        $this->generateSlug($productRepository);
        $this->getSlug()->shouldBe('product-1-1');
    }
}
