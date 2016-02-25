<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown(){
            Restaurant::deleteAll();
        }

        function test_save()
        {
            $name = "Pastini Pastaria";
            $description = "Local Italian bistro chain, speacializing in classic & contemporary pastas, with gluten-free options.";
            $test_restaurant = new Restaurant($name, $description);

            $test_restaurant->save();

            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_getId()
        {
            $name = "Pastini Pastaria";
            $description = "Local Italian bistro chain, speacializing in classic & contemporary pastas, with gluten-free options.";
            $id = 1;
            $test_restaurant = new Restaurant($name, $description, $id);

            $result = $test_restaurant->getId();

            $this->assertEquals(1, $result);
        }

        function test_getAll()
        {
            $name = "Pastini Pastaria";
            $description = "Local Italian bistro chain, speacializing in classic & contemporary pastas, with gluten-free options.";
            $name2 = "Lucca";
            $description2 = "Wood-fired pizzas, pastas & other classic Italian dished are served in a cozy, bustling dining room.";
            $test_restaurant = new Restaurant($name, $description);
            $test_restaurant2 = new Restaurant($name2, $description2);
            $test_restaurant->save();
            $test_restaurant2->save();

            $result = Restaurant::getAll();

            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function test_find()
        {
            $name = "Pastini Pastaria";
            $description = "Local Italian bistro chain, speacializing in classic & contemporary pastas, with gluten-free options.";
            $name2 = "Lucca";
            $description2 = "Wood-fired pizzas, pastas & other classic Italian dished are served in a cozy, bustling dining room.";
            $test_restaurant = new Restaurant($name, $description);
            $test_restaurant2 = new Restaurant($name2, $description2);
            $test_restaurant->save();
            $test_restaurant2->save();

            $id = $test_restaurant->getId();
            $result = Restaurant::find($id);

            $this->assertEquals($test_restaurant, $result);
        }

    }

?>
