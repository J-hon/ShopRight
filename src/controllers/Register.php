<?php

/**
 * Register controller
 */

class Register extends DB
{

    /**
     * @return bool
     */
    public function registerUser(string $username, string $password): bool
    {
        $username = trim($username);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->dsn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);

        // checking if the username is available
        $count_row = $stmt->rowCount();

        // if username is available, then insert to the table
        if ($count_row == 0)
        {
            $sql = $this->dsn->prepare("INSERT INTO users(username, password) VALUES (?, ?)");
            $result = $sql->execute([$username, $password]);
            return $result;
        } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Username already exists!!!", "Please pick a different one.", "error");';
            echo '});</script>';
            return false;
        }
    }

}