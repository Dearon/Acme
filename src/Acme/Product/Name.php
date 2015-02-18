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
    private $slug;

    public function __construct($name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('The name is required');
        }

        if (gettype($name) != "string") {
            throw new \InvalidArgumentException('The name has to be a string');
        }

        $this->name = $name;

        $slugify = new \Cocur\Slugify\Slugify();
        $this->slug = $slugify->slugify($name);
    }

    public function getName()
    {
        return $this->name;
    }
}
