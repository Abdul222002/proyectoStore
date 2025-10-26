<?php

//Añadir producto
if(isset($_GET['addCart']) && isset($_GET['product_id'])){
    $result = CartRepository::addCart($_GET['product_id']);
    if($result){
        $_SESSION['message'] = 'Producto añadido al carrito.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error al añadir el producto al carrito.';
        $_SESSION['message_type'] = 'error';
    }
    header('Location: index.php?c=cart');
    exit();
}

//Eliminar producto
if(isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['product_id'])){
    $result = CartRepository::removeFromCart($_GET['product_id']);
    header('Location: index.php?c=cart');
    exit();
}

//Vaciar carrito
if(isset($_GET['action']) && $_GET['action'] === 'clear'){
    $result = CartRepository::clearCart();
    if($result){
        $_SESSION['message'] = 'Carrito vaciado.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error al vaciar el carrito.';
        $_SESSION['message_type'] = 'error';
    }
    header('Location: index.php?c=cart');
    exit();
}



if(isset($_GET['action']) && $_GET['action'] === 'pay'){
    $result = OrderRepository::createOrder();
    if($result){
        $_SESSION['message'] = 'Pedido realizado con éxito.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error al realizar el pedido.';
        $_SESSION['message_type'] = 'error';
    }
    header('Location: index.php');
    exit();

}

require_once("views/cart.phtml");
?>