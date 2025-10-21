<?php

class CartRepository{
    public static function addCart($idProduct){
        $_SESSION['cart']=[];
        $_SESSION['cart']=ProductoRepository::getProductById($idProduct);
        var_dump(ProductoRepository::getProductById($idProduct));
    }

}
