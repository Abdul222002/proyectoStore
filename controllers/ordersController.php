<?php
    $pedidos = OrderRepository::getOrdersByUserId($_SESSION['user']->getId());
    require_once('views/orderHistory.phtml');
    
?>