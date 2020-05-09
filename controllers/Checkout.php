<?php

/** Checkout controller */

require_once "DB.php";

class Checkout
{
    public $db;
    public $user_id;
    public $bal;
    public $shipping_cost;
    public $shipping_cost_value;
    public $total = 0;
    public $subTotal = 0;
    public $no_of_items;

    public function __construct()
    {
        $this->db = new DB();
        $this->user_id = $_SESSION['id'];
        $this->no_of_items = count($_SESSION['products']);
    }

    public function getShippingCost()
    {
        $this->shipping_cost_value = $_POST['radioGroup'];

        if ($this->shipping_cost_value == "5") {
            $this->shipping_cost = 5;
        } else {
            $this->shipping_cost = 0;
        }

        return $this->shipping_cost;
    }

    public function getTotal($price, $qty, $shipping_cost)
    {
        $this->subTotal = ($price * $qty);
        $this->total = $this->total + $this->subTotal + $shipping_cost;
    }

    public function saveOrder()
    {
        $query = "INSERT INTO `orders` (`order_total`, `no_of_items`, `user_id`) VALUES ('$this->total', '$this->no_of_items', '$this->user_id');";
        $this->db->runQuery($query);
    }

    public function updateBal()
    {
        $query = "UPDATE `users` SET `current_balance` = '$this->bal' WHERE `users`.`id` = '$this->user_id'";
        $this->db->runQuery($query);
    }

    public function limit()
    {
        $query3 = "SELECT current_balance FROM `users` WHERE id ='$this->user_id'";
        $row = $this->db->fetchAssoc($query3);

        foreach ($row as $res){
            $balance = $res['current_balance'];
        }

        if (($this->total) > $balance)
        {
            die('Not enough money left');
        }
    }
}