<?php

require_once __DIR__ . '/../bootstrap/bootstrap.php';
require_once __DIR__ . '/src/product.php';

$product = new \cli\Product($entityManager, $commandBus);
$climate = new \League\CLImate\CLImate;

$help = [
    [
        'Command',
        'Description'
    ],
    [
        'import <file.json>',
        'Imports product data from the specified JSON file'
    ],
    [
        'export <file.json>',
        'Exports the current product data into the specified JSON file'
    ],
    [
        'delete <slug,slug>',
        'Takes a comma-separated list of slugs and deletes the associated products'
    ]
];

if (isset($argv[1])) {
    if ($argv[1] == 'import') {
        $product->import($argv);
    } elseif ($argv[1] == 'export') {
        $product->export($argv);
    } elseif ($argv[1] == 'delete') {
        $product->delete($argv);
    } elseif ($argv[1] == 'help') {
        $climate->table($help);
    } else {
        $climate->out('Please enter a valid command.');
    }
} else {
    $climate->table($help);
}
