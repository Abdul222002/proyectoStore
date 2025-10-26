<?php

class CartRepository {
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
            if (!isset($_SESSION['cart'][$key]->quantity)) {
                $_SESSION['cart'][$key]->quantity = 0;
            }
            $_SESSION['cart'][$key]->quantity++;
        } else {
            // Añadir nuevo producto al carrito
            $product->quantity = 1;
            $_SESSION['cart'][$key] = $product;
        }

        return true;
    }

    public static function getCart() {
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        return $_SESSION['cart'];
    }

    public static function removeFromCart($idProduct) {
        $key = (string)$idProduct;
        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
            return true;
        }
        return false;
    }

    public static function updateQuantity($idProduct, $quantity) {
        $key = (string)$idProduct;
        if (isset($_SESSION['cart'][$key])) {
            $quantity = max(0, (int)$quantity); // Asegurar que la cantidad sea no negativa
            if ($quantity === 0) {
                return self::removeFromCart($idProduct);
            }
            $_SESSION['cart'][$key]->quantity = $quantity;
            return true;
        }
        return false;
    }

    public static function clearCart() {
        $_SESSION['cart'] = [];
        return true;
    }

    public static function getTotal() {
        $total = 0;
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $total += $item->price * $item->quantity;
            }
        }
        return round($total, 2);
    }

    public static function getItemCount() {
        $count = 0;
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $count += $item->quantity;
            }
        }
        return $count;
    }
}
