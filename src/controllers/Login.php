<?php

/**
 * Login controller
 */

use App\Models\DB;

class Login extends DB
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['id']))
        {
            $this->user_id = $_SESSION['id'];
        }
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login(string $username, string $password): bool
    {

        $stmt = $this->dsn->prepare("SELECT * from users WHERE username = ?");
        $stmt->execute([$username]);
        $count_row = $stmt->rowCount();

        if ($count_row > 0)
        {
            while ($row = $stmt->fetch())
            {
                if (password_verify($password, $row['password']))
                {
                    // start session
                    $_SESSION['login'] = TRUE;
                    $_SESSION['id'] = $row['id'];
                    return true;
                }
                else {
                    return false;
                }
            }
        }

        return false;
    }

    // check user session

    public function get_session()
    {
        if (isset($_SESSION['login']))
        {
            return $_SESSION['login'];
        }
    }

    public function user_logout()
    {
        // end session
        $_SESSION['login'] = TRUE;

        session_destroy();
        header("Location: index.php");
    }

    /**
     * @return float
     */
    public function showRemainingBalance(): float
    {

        $stmt = $this->dsn->prepare("SELECT current_balance FROM `users` WHERE id = ?");
        $stmt->execute([$this->user_id]);
        $row = $stmt->fetchAll();

        foreach ($row as $res){
            $remainingBalance = $res['current_balance'];
        }

        return $remainingBalance;
    }

}