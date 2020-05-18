<?php

/**
 * Checkout controller
 */

class Checkout extends DB
{
    protected $shipping_cost;
    protected $total = 0;
    protected $subTotal = 0;
    protected $user_id;
    public $bal;
    protected $no_of_items;
    protected $shipping_cost_value;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $_SESSION['id'];
        $this->no_of_items = count($_SESSION['products']);
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return float
     */
    public function getShippingCost(): float
    {
        $this->shipping_cost_value = $_POST['radioGroup'];

        if ($this->shipping_cost_value == "5") {
            $this->shipping_cost = 5;
        } else {
            $this->shipping_cost = 0;
        }

        return $this->shipping_cost;
    }

    public function getTotal(float $price, int $qty, float $shipping_cost): float
    {
        $this->subTotal = ($price * $qty);
        $this->total = $this->total + $this->subTotal + $shipping_cost;

        return $this->total;
    }

    public function saveOrder()
    {
        $query = $this->dsn->prepare("INSERT INTO `orders` (`order_total`, `no_of_items`, `user_id`) VALUES (?, ?, ?);");
        $query->execute([$this->total, $this->no_of_items, $this->user_id]);
    }

    public function updateBal()
    {
        $query = $this->dsn->prepare("UPDATE `users` SET `current_balance` = ? WHERE `users`.`id` = ?");
        $query->execute([$this->bal, $this->user_id]);
    }

    public function limit()
    {
        $stmt = $this->dsn->prepare("SELECT current_balance FROM `users` WHERE id = ?");
        $stmt->execute([$this->user_id]);
        $row = $stmt->fetchAll();

        foreach ($row as $res){
            $balance = $res['current_balance'];
        }

        if (($this->total) > $balance)
        {
            die('Not enough money left');
        }
    }
}