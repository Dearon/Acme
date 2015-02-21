<?php

namespace Acme\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Name
{
   /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $slug = null;

    public function __construct($name, $slug = false)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('The name is required');
        }

        if (gettype($name) != "string") {
            throw new \InvalidArgumentException('The name has to be a string');
        }

        if (empty($slug)) {
            throw new \InvalidArgumentException('The slug is required');
        }

        if (gettype($slug) != "string") {
            throw new \InvalidArgumentException('The slug has to be a string');
        }

        $this->name = $name;
        $this->slug = $slug;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }
}
