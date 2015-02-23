<?php

require_once '../vendor/autoload.php';

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
        Acme\Product\AddProductCommand::class => new \Acme\Product\AddProductHandler($entityManager)
    ]
);