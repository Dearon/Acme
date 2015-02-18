<?php

namespace Acme\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */

class Product
{
    private $entityManager;

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Embedded(class="Acme\Product\Name")
     */
    private $name;

    /**
     * @ORM\Embedded(class="Acme\Product\Price")
     */
    private $price;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager, \Acme\Product\Name $name, \Acme\Product\Price $price)
    {
        $this->entityManager = $entityManager;
        $this->id = (string) \Rhumsaa\Uuid\Uuid::uuid1();
        $this->name = $name;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name->getName();
    }

    public function getSlug()
    {
        return $this->name->getSlug();
    }

    public function setName(\Acme\Product\Name $name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price->getPrice();
    }

    public function setPrice(\Acme\Product\Price $price)
    {
        $this->price = $price;
    }

    public function save()
    {
        if (! $this->getSlug())
            $this->name->generateSlug(new \Acme\Product\ProductRepository($this->entityManager));

        $this->entityManager->persist($this);
        $this->entityManager->flush();
    }
}
