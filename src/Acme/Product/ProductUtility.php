<?php

namespace Acme\Product;

class ProductUtility
{
    private $productRepository;
    private $slugify;

    function __construct(\Acme\Product\ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->slugify = new \Cocur\Slugify\Slugify();
    }

    function findFreeSlug($name, $increment = 0)
    {
        $slug = $this->slugify->slugify($name);
        if ($increment > 0)
            $slug = "$slug-$increment";

        if ($this->productRepository->findBySlug($slug))
            return $this->findFreeSlug($name, $increment + 1);
        else
            return $slug;
    }
}
