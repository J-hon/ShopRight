<?php

/** Login controller */

require_once "DB.php";

class Login
{
    public $db;

    public function __construct()
    {
        error_reporting(0);
        $this->db = new DB();
    }

    public function login($username, $password)
    {
        $password = md5($password);
        $sql2 = "SELECT * from users WHERE username = '$username' and password = '$password'";

        $result = $this->db->runQuery($sql2);
        $user_data = $this->db->fetchArray($result);
        $count_row = $this->db->numRows($result);

        if ($count_row == 1)
        {
            // start session
            $_SESSION['login'] = TRUE;
            $_SESSION['id'] = $user_data['id'];
            return true;
        } else {
            return false;
        }
    }

    // check user session
    public function get_session()
    {
        return $_SESSION['login'];
    }

    public function user_logout()
    {
        $_SESSION['login'] = TRUE;

        session_destroy();
//        unset($_SESSION['id']);
        header("Location: index.php");
    }

}