
<?php

class ProductoRepository {
    public function getProductDetailsByProductId($product_id) {
        $db = Connection::connect();
        $q = "SELECT * FROM products WHERE id = ?";
        $result = $db->query($q);
        $row= mysqli_fetch_assoc($result);
        return $row ? new Product(
            $row['id'],
            $row['name'],
            $row['description'],
            $row['category'],
            $row['price'],
            $row['stock'],
            $row['image']
        ) : null;
    }

    public function getAllProducts() {
        $db = Connection::connect();
        $q = "SELECT * FROM products";
        $result = $db->query($q);
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = new Product(
                $row['id'],
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