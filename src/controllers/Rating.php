<?php

/**
 * Rating controller
 */

class Rating extends DB
{

    public function rate()
    {
        $user = $_SESSION['id'];
        $rate = $_POST['rate'];
        $product = $_POST['product_id'];

        $stmt = $this->dsn->prepare("SELECT * FROM ratings where user_id = ? and product_id = ?");
        $stmt->execute([$user, $product]);

        while($data = $stmt->fetch()) {
            $rate_db[] = $data;
        }

        if($stmt->rowCount() == 0) {
            $stmt1 = $this->dsn->prepare("INSERT INTO ratings (product_id, user_id, rate)VALUES(?, ?, ?)");

            $stmt1->bindParam(1, $product, PDO::PARAM_INT);
            $stmt1->bindParam(2, $user, PDO::PARAM_INT);
            $stmt1->bindParam(3, $rate, PDO::PARAM_INT);

            $stmt1->execute();
        }
    }
}