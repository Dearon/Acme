<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductUtilitySpec extends ObjectBehavior
{
    function let(\Acme\Product\ProductRepository $productRepository)
    {
        $this->beConstructedWith($productRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\ProductUtility');
    }

    function it_should_generate_a_slug(\Acme\Product\ProductRepository $productRepository)
    {
        $productRepository->findBySlug('product-1')->willReturn(null);
        $this->beConstructedWith($productRepository);
        $this->findFreeSlug('Product 1')->shouldBe('product-1');
    }

    function it_should_not_generate_a_duplicate_slug(\Acme\Product\ProductRepository $productRepository)
    {
        $productRepository->findBySlug('product-1')->willReturn(true);
        $productRepository->findBySlug('product-1-1')->willReturn(null);
        $this->beConstructedWith($productRepository);
        $this->findFreeSlug('Product 1')->shouldBe('product-1-1');
    }
}
