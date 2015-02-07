<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Acme\ProductRepository;

class CartSpec extends ObjectBehavior
{
    private $productRepository;

    function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Cart');
    }

    function it_can_receive_a_single_product()
    {
        $this->add($this->productRepository->find("Product"));
        $this->get()->shouldHaveCount(1);
    }

    function it_can_receive_multiple_products()
    {
        $this->add($this->productRepository->find("Product 1"));
        $this->add($this->productRepository->find("Product 2"));
        $this->add($this->productRepository->find("Product 3"));
        $this->get()->shouldHaveCount(3);
    }
}
