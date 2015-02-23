<?php

namespace spec\Acme\Product;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddProductHandlerSpec extends ObjectBehavior
{
    function let(\Doctrine\ORM\EntityManager $em)
    {
        $this->beConstructedWith($em);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\AddProductHandler');
    }
}
