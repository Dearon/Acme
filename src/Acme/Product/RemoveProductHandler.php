<?php

namespace Acme\Product;

class RemoveProductHandler
{
    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function handle(\Acme\Product\RemoveProductCommand $command)
    {
        $this->em->remove($command->getProduct());
        $this->em->flush();
    }
}
