<?php

require_once __DIR__ . '/../vendor/autoload.php';

$isDevMode = true;
$entityPaths = array(
    __DIR__ . "/../src/Acme/Product"
);
$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($entityPaths, $isDevMode, null, null, false);

$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . "/../database/db.sqlite"
);

$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);

$commandBus = League\Tactician\Setup\QuickStart::create(
    [
        Acme\Product\Command\AddProduct::class => new \Acme\Product\Handler\AddProduct($entityManager),
        Acme\Product\Command\EditProduct::class => new \Acme\Product\Handler\EditProduct($entityManager),
        Acme\Product\Command\RemoveProduct::class => new \Acme\Product\Handler\RemoveProduct($entityManager)
    ]
);