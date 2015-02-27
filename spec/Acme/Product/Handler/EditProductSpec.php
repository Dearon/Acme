<?php

namespace spec\Acme\Product\Handler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EditProductSpec extends ObjectBehavior
{
    function let(\Doctrine\ORM\EntityManager $em)
    {
        $this->beConstructedWith($em);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Product\Handler\EditProduct');
    }
}
