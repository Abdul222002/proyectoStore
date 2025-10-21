<?php

class OrderRepository {
    
    public static function getOrdersByUserId($user_id) {
        $db = Connection::connect();
        $q = "SELECT * FROM orders WHERE user_id = ?";
        $result = $db->query($q);
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = new Order(
                $row['id'],
                $row['user_id'],
                $row['total'],
                $row['status'],
                $row['order_date']
            );
        }
        return $orders;
        
    }

    public static function addProductOrder($product_id) {
        $product= ProductoRepository::getProductById($product_id);
        if($product){
            
        }

    }
}

?>