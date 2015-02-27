<?php

namespace cli;

class Product
{
    private $em;
    private $commandBus;
    private $climate;
    private $productRepository;

    public function __construct($em, $commandBus)
    {
        $this->em = $em;
        $this->commandBus = $commandBus;
        $this->climate = new \League\CLImate\CLImate;
        $this->productRepository = new \Acme\Product\ProductRepository($this->em);
    }

    public function import($argv)
    {
        if (! isset($argv[2])) {
            $this->climate->out('You need to specify a filename');
            return;
        }

        if (! is_file($argv[2])) {
            $this->climate->out('Could not find the file "' . $argv[2] . '"');
            return;
        }

        $json = file_get_contents($argv[2]);
        $json = json_decode($json);

        if ($json === null) {
            $this->climate->out('The file "' . $argv[2] . '" is not valid JSON');
            return;
        }

        if (! isset($json->products)) {
            $this->climate->out('The JSON file needs a products array');
            return;
        }

        foreach ($json->products as $product) {
            if (! isset($product->name)) {
                $this->climate->out('Could not import all products, every product needs a name');
                return;
            }

            if (! isset($product->price)) {
                $this->climate->out('Could not import all products, every product needs a price');
                return;
            }

            if (! isset($product->description)) {
                $this->climate->out('Could not import all products, every product needs a description');
                return;
            }

            try {
                $command = new \Acme\Product\Command\AddProduct($product->name, $product->price, $product->description);
                $this->commandBus->handle($command);
            } catch (\Exception $e) {
                $this->climate->out('Failed to import product with the name ' . $product->name);
                $this->climate->out($e->getMessage());
                return;
            }
        }

        $this->climate->out('The products have been imported');
    }

    public function export($argv)
    {
        if (! isset($argv[2])) {
            $this->climate->out('You need to specify a filename');
            return;
        }

        if (file_exists($argv[2]) && ! is_writable($argv[2])) {
            $this->climate->out('Can not write to the file ' . $argv[2]);
            return;
        }

        $productsArray = array('products' => array());
        $products = $this->productRepository->findAll();

        foreach ($products as $product) {
            $productsArray['products'][] = array(
                'id' => $product->getId(),
                'name' => $product->getName(),
                'slug' => $product->getSlug(),
                'price' => number_format($product->getPrice(), 2),
                'description' => $product->getDescription()
            );
        }

        $json = json_encode($productsArray, JSON_PRETTY_PRINT);

        if (file_put_contents($argv[2], $json)) {
            $this->climate->out('The data has been written to ' . $argv[2]);
        } else {
            $this->climate->out('Could not write to ' . $argv[2]);
        }
    }

    public function delete($argv)
    {
        if (! isset($argv[2])) {
            $this->climate->out('You need to specify a list of slugs to delete');
            return;
        }

        $slugs = explode(',', $argv[2]);

        foreach ($slugs as $slug) {
            $product = $this->productRepository->findBySlug($slug);

            if ($product) {
                $command = new \Acme\Product\Command\RemoveProduct($product);
                $this->commandBus->handle($command);
                $this->climate->out('The product with the slug ' . $slug . ' was deleted');
            } else {
                $this->climate->out('Could not find a product with the slug ' . $slug);
            }
        }
    }
}
