<?php

/** Login controller */

require_once "DB.php";

class Login
{
    public $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function check_login($username, $password)
    {
        $password = md5($password);
        $sql2 = "SELECT id from users WHERE username = '$username' and password = '$password'";

        $result = $this->db->runQuery($sql2);
        $user_data = $this->db->fetchArray($result);
        $count_row = $this->db->numRows($result);

        if ($count_row == 1)
        {
            // start session
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user_data['id'];
            return true;
        } else {
            return false;
        }
    }

    public function get_username($id)
    {
        $sql3="SELECT username FROM users WHERE id = '$id'";
        $result = $this->db->runQuery($sql3);
        $user_data = $this->db->fetchArray($result);

        echo $user_data['username'];
    }

    // check user session
    public function get_session()
    {
        return $_SESSION['login'];
    }

    public function user_logout()
    {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }

}