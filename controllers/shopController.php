<?php

//Cargamos el modelo
if (!isset($_SESSION['user']) && isset($_GET['login'] ) && $_GET['login'] == 'true') {
    require_once('views/login.phtml');
    exit();
}else{
    $products = ProductoRepository::getAllProducts();
    require_once('views/home.phtml');
}
?>