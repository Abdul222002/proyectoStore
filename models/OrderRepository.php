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

   public static function createOrder() {
    $db = Connection::connect();
    $user_id = $_SESSION['user']->getId();
    $cart = CartRepository::getCart();
    $total = 0;

    foreach ($cart as $item) {
        $total += $item->getPrice() * $item->quantity;
    }

    // INSERT corregido: solo 3 columnas (user_id, total, status)
    $q = "INSERT INTO orders (user_id, total, status) VALUES (?, ?, 'pendiente')";
    $stmt = $db->prepare($q);
    $stmt->bind_param("id", $user_id, $total);

    //ELiminar el stock del producto que se ha comprado
    foreach ($cart as $item) {
        ProductoRepository::decreaseStock($item->getId(), $item->quantity);
    }

    if ($stmt->execute()) {
        $order_id = $db->insert_id;

        foreach ($cart as $item) {
            $q2 = "INSERT INTO order_details (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)";
            $stmt2 = $db->prepare($q2);
            $stmt2->bind_param("iiid", $order_id, $item->getId(), $item->quantity, $item->getPrice());
            $stmt2->execute();
        }

        CartRepository::clearCart();
        return true;
    }

    return false;
}

}

?>