<?php
require_once("views/cart.phtml");

$db = Connection::connect();

$cartItems = [];

//Añadir producto
if(isset($_GET['addCart'])){
    CartRepository::addCart($_GET['product_id']);
    header('Location: index.php?c=cart');
}


?>