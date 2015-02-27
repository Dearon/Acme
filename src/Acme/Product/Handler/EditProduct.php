<?php

namespace Acme\Product\Handler;

class EditProduct
{
    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function handle(\Acme\Product\Command\EditProduct $command)
    {
        $product = $command->getProduct();

        if ($command->getName() !== null) {
            $product->setName(new \Acme\Product\Name($command->getName()));
        }

        if ($command->getPrice() !== null) {
            $product->setPrice(new \Acme\Product\Price($command->getPrice()));
        }

        if ($command->getDescription() !== null) {
            $product->setDescription(new \Acme\Product\Description($command->getDescription()));
        }

        $this->em->persist($product);
        $this->em->flush();
    }
}
