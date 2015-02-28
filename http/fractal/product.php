<?php

namespace HTTP\Fractal;

class Product
{
    public function transform($product)
    {
        $fractal = new \League\Fractal\Manager();
        $product = array($product);

        $resource = new \League\Fractal\Resource\Collection($product, function(\Acme\Product\Product $product) {
            return [
                'name' => $product->getName(),
                'slug' => $product->getSlug(),
                'price' => number_format($product->getPrice(), 2),
                'description' => $product->getDescription()
            ];
        });

        $data = $fractal->createData($resource)->toArray();
        return $data['data'][0];
    }
}
