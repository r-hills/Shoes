<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = '';
    $DB = new PDO($server, $username, $password);


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

// All Stores list pages 

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig',
            array('stores' => Store::getAll() ) );
    });

    $app->post("/stores", function() use ($app) {
        $store = new Store( 
            preg_quote($_POST['name'], "'"),
            preg_quote($_POST['address'], "'"),
            preg_quote($_POST['phone'], "'")
        );
        $store->save();
        return $app['twig']->render('stores.html.twig',
            array('stores' => Store::getAll() ) );
    });

// Single Store pages 

    $app->get("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $brands = $store->getBrands();
        return $app['twig']->render('store.html.twig',
            array('store' => $store, 'brands' => $brands ) );
    });

    $app->post("/store/{id}", function($id) use ($app) {
        $brand = new Brand( 
            preg_quote($_POST['brand'], "'")
        );
        $brand->save();
        $store = Store::find($id);
        $store->addBrand($brand);
        $brands = $store->getBrands(); 
        return $app['twig']->render('store.html.twig',
            array('store' => $store, 'brands' => $brands ) );

    });

    $app->patch("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->updateName( preg_quote($_POST['name'], "'") );
        $store->updateAddress( preg_quote($_POST['address'], "'") );
        $store->updatePhone( preg_quote($_POST['phone'], "'") );    
        $brands = $store->getBrands(); 
        return $app['twig']->render('store.html.twig',
            array('store' => $store, 'brands' => $brands ) );

    });






    return $app; 

?>