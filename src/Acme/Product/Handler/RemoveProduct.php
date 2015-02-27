<?php

namespace Acme\Product\Handler;

class RemoveProduct
{
    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function handle(\Acme\Product\Command\RemoveProduct $command)
    {
        $this->em->remove($command->getProduct());
        $this->em->flush();
    }
}
