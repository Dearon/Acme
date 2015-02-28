<?php

namespace HTTP\Fractal;

class Products
{
    public function transform($products)
    {
        $fractal = new \League\Fractal\Manager();

        $resource = new \League\Fractal\Resource\Collection($products, function(\Acme\Product\Product $product) {
            return [
                'name' => $product->getName(),
                'slug' => $product->getSlug(),
                'price' => number_format($product->getPrice(), 2),
                'description' => $product->getDescription()
            ];
        });

        $data = $fractal->createData($resource)->toArray();
        return $data['data'];
    }
}