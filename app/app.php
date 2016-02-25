<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Restaurant.php";
    require_once __DIR__."/../src/Cuisine.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=restaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array (
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app){
        return $app['twig']->render('Index.html.twig');
    });

    $app->post("/results", function() use ($app){
        $Restaurant = new Restaurant($_POST['restaurant'], $_POST['description']);
        $new_restaurant = $Restaurant->save();

        return $app['twig']->render('page2.html.twig', array('results' => Restaurant::getAll()));
    });


    return $app;
?>
