<?php

namespace Acme\Product;

use \Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Description
{
    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function __construct($description)
    {
        if (empty($description)) {
            throw new \InvalidArgumentException('The description is required');
        }

        if (gettype($description) != "string") {
            throw new \InvalidArgumentException('The description has to be a string');
        }

        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
