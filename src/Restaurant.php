<?php
    class Restaurant{
        private $name;
        private $description;
        private $id;

        function __construct($name, $description, $id = null){
            $this->name = $name;
            $this->description = $description;
            $this->id = $id;
        }

        function getId() {
            return $this->id;
        }

        function getName() {
            return $this->name;
        }

        function setName($new_name) {
            $this->name = (string) $new_name;
        }

        function getDescription() {
            return $this->description;
        }

        function setDescription($new_description) {
            $this->description = (string) $new_description;
        }

        function save(){
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, description) VALUES('{$this->getName()}', '{$this->getDescription()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function deleteAll(){
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        static function getALL()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach ($returned_restaurants as $restaurant){
                $name = $restaurant['name'];
                $description = $restaurant['description'];
                $id = $restaurant['id'];
                $new_restaurant = new Restaurant($name, $description, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function find($search_id){
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant){
                $restaurant_id = $restaurant->getId();
                if($search_id == $restaurant_id){
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }

    }
?>
