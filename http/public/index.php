<?php

require_once __DIR__  . '/../../bootstrap/bootstrap.php';
require_once __DIR__  . '/../fractal/product.php';
require_once __DIR__  . '/../fractal/products.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));
$app->register(new Silex\Provider\SessionServiceProvider());

$app['debug'] = true;
$app['ProductRepository'] = new \Acme\Product\ProductRepository($entityManager);
$app['Cart'] = new \Acme\Cart\Cart($app['session']->get('cart'));

$app->get('/', function() use ($app) {
    $transform = new \HTTP\Fractal\Products;
    $products = $app['ProductRepository']->findAll();
    $products = $transform->transform($products);
    return $app['twig']->render('index.twig', array('products' => $products, 'cart' => $app['Cart']->getProducts()));
});

$app->get('/product/{slug}', function($slug) use ($app) {
    $product = $app['ProductRepository']->findBySlug($slug);

    if ($product) {
        $transform = new \HTTP\Fractal\Product;
        $product = $transform->transform($product);
        return $app['twig']->render('product.twig', array('product' => $product, 'cart' => $app['Cart']->getProducts()));
    } else {
        return $app->abort(404, 'We do not have a product with that slug.');
    }
});

$app->get('/cart', function() use ($app) {
    $transform = new \HTTP\Fractal\Products;
    $products = $transform->transform($app['Cart']->getProducts());
    $total = number_format($app['Cart']->getPrice(), 2);
    return $app['twig']->render('cart.twig', array('cart' => $products, 'total' => $total));
});

$app->get('/cart/add/{slug}', function($slug) use ($app) {
    $product = $app['ProductRepository']->findBySlug($slug);

    if ($product) {
        $app['Cart']->addProduct($product);
        $app['session']->set('cart', serialize($app['Cart']->getProducts()));
        return $app->redirect('/cart');
    } else {
        return $app->abort(404, 'We do not have a product with that slug.');
    }
});

$app->get('/cart/remove/{slug}', function($slug) use ($app) {
    $product = $app['ProductRepository']->findBySlug($slug);

    if ($product) {
        $app['Cart']->removeProduct($product);
        $app['session']->set('cart', serialize($app['Cart']->getProducts()));
        return $app->redirect('/cart');
    } else {
        return $app->abort(404, 'We do not have a product with that slug.');
    }
});

$app->get('/order', function() use ($app) {
    $app['session']->remove('cart');
    return $app['twig']->render('order.twig');
});

$app->run();