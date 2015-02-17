<?php

namespace Acme\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */

class Product
{
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

    public function __construct(\Acme\Product\Name $name, \Acme\Product\Price $price)
    {
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

    public function getPrice()
    {
        return $this->price->getPrice();
    }
}
