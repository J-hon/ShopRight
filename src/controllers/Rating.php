<?php

/** Rating controller */

require_once "DB.php";

class Rating
{
    public $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function rate()
    {
        $user = $_SESSION['id'];
        $rate = $_POST['rate'];
        $product = $_POST['product_id'];

        $query = $this->db->runQuery("SELECT * FROM ratings where user_id= '$user' and product_id = '$product'");

        while($data = $this->db->fetchArray($query)) {
            $rate_db[] = $data;
        }

        if(count($rate_db) == 0) {
            $this->db->runQuery("INSERT INTO ratings (product_id, user_id, rate)VALUES('$product', '$user', '$rate')");
        }
    }
}