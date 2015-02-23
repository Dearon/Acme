<?php

namespace Acme\Product;

class ProductRepository
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    private function getRepository()
    {
        return $this->entityManager->getRepository("\Acme\Product\Product");
    }

    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    public function findBySlug($slug)
    {
        return $this->getRepository()->findOneBy(array('name.slug' => $slug));
    }
}
