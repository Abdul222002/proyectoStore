<?php

class CartRepository{
    public static function addCart($idProduct){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart']=[];
        }
        $product = ProductoRepository::getProductById($idProduct);

        if($product){
            // si ya existe
            if(isset($_SESSION['cart'][$idProduct])) {
                $_SESSION['cart'][$idProduct]['quantity']++;
            }else{
                // si no existe
                $_SESSION['cart'][$idProduct] = [
                    'product_id' => $product->getId(),
                    'name'       => $product->getName(),
                    'price'      => $product->getPrice(),
                    'image'      => $product->getImage(),
                    'quantity'   => 1
                ];
            }
        }
    }

}
