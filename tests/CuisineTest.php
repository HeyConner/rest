<?php

  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase {

        protected function tearDown()
        {
            Cuisine::deleteAll();
        }

        function test_save()
        {

          $type = "italian";
          $test_cuisine = new Cuisine($type);
          $test_cuisine->save();

          $result = Cuisine::getAll();
          $this->assertEquals($test_cuisine, $result[0]);
        }

        function test_getAll()
        {
            $type = "italian";
            $type2 = "american";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($type2);
            $test_cuisine2->save();

            $result = Cuisine::getAll();

            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function test_getId()
        {
            $type = "italian";
            $id = 1;
            $test_cuisine = new Cuisine($type, $id);

            $result = $test_cuisine->getId();

            $this->assertEquals(1, $result);
        }

        function test_find(){
            $type = "italian";
            $type2 = "vegan";
            $test_cuisine = new Cuisine($type);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($type2);
            $test_cuisine2->save();

            $id = $test_cuisine->getId();
            $result = Cuisine::find($id);

            $this->assertEquals($test_cuisine, $result);
        }
    }
 ?>
