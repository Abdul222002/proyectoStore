
<?php

class ProductoRepository {
    public static function getProductById($product_id) {
        $db = Connection::connect();
        $q = "SELECT * FROM products WHERE product_id = '" . $product_id . "'";
        $result = $db->query($q);
        $row= mysqli_fetch_assoc($result);
        return $row ? new Product(
            $row['product_id'],
            $row['name'],
            $row['description'],
            $row['category'],
            $row['price'],
            $row['stock'],
            $row['image']
        ) : null;
    }

    public static function getAllProducts() {
        $db = Connection::connect();
        $q = "SELECT * FROM products";
        $result = $db->query($q);
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = new Product(
                $row['product_id'],
                $row['name'],
                $row['description'],
                $row['category'],
                $row['price'],
                $row['stock'],
                $row['image']
            );
        }
        return $products;
    }
}
?>