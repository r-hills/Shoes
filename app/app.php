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

    $app->get("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
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
        $all_brands = Brand::getAll(); 
        return $app['twig']->render('store.html.twig',
            array('store' => $store, 'brands' => $brands, 'all_brands' => Brand::getAll() ) );
    });

    $app->post("/store/{id}", function($id) use ($app) {
        $brand = Brand::find($_POST['brand']);
        $store = Store::find($id);
        $store->addBrand($brand);
        $brands = $store->getBrands();      
        return $app['twig']->render('store.html.twig',
            array('store' => $store, 'brands' => $brands, 'all_brands' => Brand::getAll() ) );

    });

    $app->patch("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->updateName($_POST['name']);
        $store->updateAddress($_POST['address']);
        $store->updatePhone($_POST['phone']);  
        $brands = $store->getBrands(); 
        return $app['twig']->render('store.html.twig',
            array('store' => $store, 'brands' => $brands, 'all_brands' => Brand::getAll() ) );

    });


    $app->delete("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('stores.html.twig',
            array('stores' => Store::getAll() ) );
    });

// Brands list pages

    $app->get("/brands", function() use ($app) {
        return $app['twig']->render('brands.html.twig',
            array('brands' => Brand::getAll() ) );
    });

    $app->get("/brands/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->delete();
        return $app['twig']->render('brands.html.twig',
            array('brands' => Brand::getAll() ) );
    });


    $app->post("/brands", function() use ($app) {
        $brand = new Brand( 
            preg_quote($_POST['name'], "'")
        );
        $brand->save();
        return $app['twig']->render('brands.html.twig',
            array('brands' => Brand::getAll() ) );
    });

// Single Brand pages 

    $app->get("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $stores = $brand->getStores();
        return $app['twig']->render('brand.html.twig',
            array('brand' => $brand, 'stores' => $stores, 'all_stores' => Store::getAll() ) );
    });

    $app->post("/brand/{id}", function($id) use ($app) {
        $store = Store::find($_POST['store']);
        $brand = Brand::find($id);
        $brand->addStore($store);
        $stores = $brand->getStores(); 
        return $app['twig']->render('brand.html.twig',
            array('brand' => $brand, 'stores' => $stores, 'all_stores' => Store::getAll() ) );

    });

    $app->patch("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->updateName($_POST['name']);
        $stores = $brand->getStores(); 
        return $app['twig']->render('brand.html.twig',
            array('brand' => $brand, 'stores' => $stores, 'all_stores' => Store::getAll() ) );
    });


    $app->delete("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->delete();
        return $app['twig']->render('brands.html.twig',
            array('brands' => Brand::getAll() ) );
    });



    return $app; 

?>