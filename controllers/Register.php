<?php

/** Register controller */

require_once "DB.php";

class Register
{
    public $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function register($username, $password)
    {
        $username = trim($username);
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE username='$username'";

        // checking if the username is available
        $check =  $this->db->runQuery($sql) ;
        $count_row = $this->db->numRows($check);

        // if username is available, then insert to the table
        if ($count_row == 0)
        {
            $sql1 = "INSERT INTO users(username, password) VALUES ('$username','$password')";
            $result = $this->db->runQuery($sql1);
            return $result;
        } else {
            return false;
        }
    }

}