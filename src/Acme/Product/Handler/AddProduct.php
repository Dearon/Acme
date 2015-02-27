<?php

namespace Acme\Product\Handler;

class AddProduct
{
    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function handle(\Acme\Product\Command\AddProduct $command)
    {
        $productRepository = new \Acme\Product\ProductRepository($this->em);
        $utility = new \Acme\Product\ProductUtility($productRepository);

        $slug = $utility->findFreeSlug($command->getName());
        $name = new \Acme\Product\Name($command->getName(), $slug);
        $price = new \Acme\Product\Price($command->getPrice());
        $description = new \Acme\Product\Description($command->getDescription());

        $product = new \Acme\Product\Product($name, $price, $description);
        $this->em->persist($product);
        $this->em->flush();
    }
}
