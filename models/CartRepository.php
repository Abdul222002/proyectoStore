<?php

class CartRepository{
     public static function addCart($idProduct) {

        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // normalizar key como string para evitar colisiones int/string
        $key = (string)$idProduct;

        $product = ProductoRepository::getProductById($idProduct);

        if (!$product) {
            return false; // no existe
        }

        if (isset($_SESSION['cart'][$key])) {
            // incrementar cantidad en el objeto ya guardado
            // asegurarse de que quantity exista y sea entero
            if (!isset($_SESSION['cart'][$key]->quantity)) {
                $_SESSION['cart'][$key]->quantity = 0;
            }
            $_SESSION['cart'][$key]->quantity++;
        } else {
            // clonar para evitar referencias a la misma instancia en memoria
            $prodCopy = clone $product;
            // inicializar cantidad (propiedad dinámica)
            $prodCopy->quantity = 1;
            $_SESSION['cart'][$key] = $prodCopy;
        }

        // opcional: forzar que PHP escriba la sesión inmediatamente
        session_write_close();

        return true;
    }

    public static function getCart() {
        self::ensureSessionStarted();
        return $_SESSION['cart'] ?? [];
    }

    public static function clearCart() {
        self::ensureSessionStarted();
        unset($_SESSION['cart']);
    }
}
