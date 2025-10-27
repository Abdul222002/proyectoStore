<?php
    $product = ProductoRepository::getProductById($_GET['id']);
    require_once('views/productView.phtml');

    
?>