<?php

/**
 * Database controller
 */

declare(strict_types = 1);

namespace App\Models;
use \PDO;

session_start();
error_reporting(0);

class DB
{

    private  $server = "mysql:host=localhost;dbname=ABC_SC";
    private $user = "ABC_SC";
    private $password = "";
    private $options  = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    protected $con;
    public $dsn;
    protected $currency = '&#36;';

    public function __construct()
    {
        $this->dsn = $this->connectDB();
    }

    /**
     * @return PDO
     */
    public function connectDB()
    {
        try
        {
            $this->con = new PDO($this->server, $this->user,$this->password,$this->options);
            return $this->con;
        }
        catch (\PDOException $e)
        {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

}