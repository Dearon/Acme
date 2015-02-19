<?php

namespace Acme\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Price
{
    /**
     * @ORM\Column(type="float")
     */
    private $price;

    public function __construct($price)
    {
        if (empty($price)) {
            throw new \InvalidArgumentException('The price is required');
        }

        if (gettype($price) != "double" && gettype($price) != "integer") {
            throw new \InvalidArgumentException('The price has to be a double');
        }

        if ($price < 0.01) {
            throw new \InvalidArgumentException('The price has to be a positive number');
        }

        $this->price = round($price, 2);
    }

    public function getPrice()
    {
        return round($this->price, 2);
    }
}
