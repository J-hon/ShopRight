<?php

/** Database controller */

session_start();

class DB
{

    private $host = "localhost";
    private $user = "ABC_SC";
    private $password = "";
    private $database = "ABC_SC";
    public $conn;

    public $currency = '&#36;';

    public function __construct()
    {
        $this->conn = $this->connectDB();
    }

    private function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("Connection failed: " . mysqli_connect_error());

        if (mysqli_connect_errno())
        {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        return $conn;
    }

    // Run a single query
    public function runQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // Fetch an associative array from database
    public function fetchArray($result)
    {
        $fetchAssoc = mysqli_fetch_assoc($result);
        return $fetchAssoc;
    }

    // Fetch number of rows from database
    public function numRows($result)
    {
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

    // Combination of runQuery and fetchArray
    public function fetchAssoc($query)
    {
        $result = mysqli_query($this->conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $resultset[] = $row;
        }

        if(!empty($resultset)) return $resultset;
    }
}
    
?>