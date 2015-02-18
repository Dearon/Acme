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

    private $slugify;

    public function __construct($name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('The name is required');
        }

        if (gettype($name) != "string") {
            throw new \InvalidArgumentException('The name has to be a string');
        }

        $this->name = $name;
        $this->slugify = new \Cocur\Slugify\Slugify();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function generateSlug(\Acme\Product\ProductRepository $repository, $increment = 0)
    {
        $slug = $this->slugify->slugify($this->name);
        if ($increment > 0)
            $slug = "$slug-$increment";

        if ($repository->findBySlug($slug))
            $this->generateSlug($repository, $increment + 1);
        else
            $this->slug = $slug;
    }
}
