<?php
session_start();

$productos = [
    1 => ['nombre' => 'Agne Minion', 'precio' => 6.00, 'imagen' => 'img/minion2.jpg'],
    2 => ['nombre' => 'Don Quijote', 'precio' => 4.00, 'imagen' => 'img/donquijote2.jpg'],
    3 => ['nombre' => 'Don Quijote', 'precio' => 5.00, 'imagen' => 'img/donquijote3.jpg'],
    4 => ['nombre' => 'Minion Bob', 'precio' => 5.00, 'imagen' => 'img/minion.jpg'],
    5 => ['nombre' => 'Harry Poter', 'precio' => 6.00, 'imagen' => 'img/hp2.jpg'],
    6 => ['nombre' => 'Minion Stu.', 'precio' => 10.00, 'imagen' => 'img/minion4.jpg'],
    7 => ['nombre' => 'Harry Poter', 'precio' => 4.00, 'imagen' => 'img/hp.jpg'],
    8 => ['nombre' => 'Don Quijote', 'precio' => 7.00, 'imagen' => 'img/donquijote4.jpg'],
    9 => ['nombre' => 'Don Quijote', 'precio' => 6.00, 'imagen' => 'img/donquijote5.jpg'],
    10 => ['nombre' => 'Princesas', 'precio' => 8.00, 'imagen' => 'img/princes.jpg'],
    11 => ['nombre' => 'Princesas', 'precio' => 4.00, 'imagen' => 'img/princes2.jpg'],
    12 => ['nombre' => 'Princesas', 'precio' => 3.00, 'imagen' => 'img/princes3.jpg'],
    14 => ['nombre' => 'Lenguajes', 'precio' => 6.00, 'imagen' => 'img/lenguaje.jpg'],
    15 => ['nombre' => 'Lenguajes', 'precio' => 5.00, 'imagen' => 'img/lenguaje2.jpg'],
    16 => ['nombre' => 'Cars Coche', 'precio' => 5.00, 'imagen' => 'img/car.jpg'],
    17 => ['nombre' => 'Minion Bob', 'precio' => 8.00, 'imagen' => 'img/minion3.jpg'],
    18 => ['nombre' => 'Zorrito', 'precio' => 7.00, 'imagen' => 'img/zorro.jpg'],
    19 => ['nombre' => 'Cars', 'precio' => 5.00, 'imagen' => 'img/car2.jpg'],
];

function inicializarHistorialPedidos() {
    if (!isset($_SESSION['historial_pedidos'])) {
        $_SESSION['historial_pedidos'] = [];
    }
}


function inicializarFavoritos(){
    if (!isset($_SESSION['favoritos'])) {
        $_SESSION['favoritos'] = [];
    }
}


function inicializarCarrito() {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
}

function agregarProductoAlCarrito() {
    if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'agregar') {
        $producto_id = $_GET['id'];
        agregarAlCarrito($producto_id);
        echo obtenerCantidadEnCarrito();
        exit();
    }
}

function agregarAlCarrito($producto_id) {
    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]++;
    } else {
        $_SESSION['carrito'][$producto_id] = 1;
    }
}

function obtenerCantidadEnCarrito() {
    return isset($_SESSION['carrito']) ? array_sum($_SESSION['carrito']) : 0;
}


function obtenerPrecioProducto($producto_id) {
    global $productos; // Accede al arreglo de productos declarado en common.php

    // Verifica si el producto existe en el arreglo y devuelve su precio
    return isset($productos[$producto_id]) ? $productos[$producto_id]['precio'] : 0;
}

function agregarAFavoritos($producto_id) {
    $_SESSION['favoritos'][$producto_id] = true;
}

function manejarAgregarAFavoritos() {
    if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'agregarFavorito') {
        $producto_id = $_GET['id'];
        agregarAFavoritos($producto_id);
        echo "Producto agregado a favoritos";
        exit();
    }
}




function eliminarDeFavoritos($producto_id) {
    unset($_SESSION['favoritos'][$producto_id]);
}

function manejarAgregarYEliminarFavoritos() {
    if (isset($_GET['action'], $_GET['id'])) {
        $producto_id = $_GET['id'];
        if ($_GET['action'] === 'agregarFavorito') {
            agregarAFavoritos($producto_id);
            echo "Producto agregado a favoritos";
        } elseif ($_GET['action'] === 'eliminarFavorito') {
            eliminarDeFavoritos($producto_id);
            echo "Producto eliminado de favoritos";
        }
        exit();
    }
}

function esFavorito($producto_id) {
    return isset($_SESSION['favoritos'][$producto_id]);
}


function eliminarDelCarrito($producto_id) {
    if (isset($_SESSION['carrito'][$producto_id])) {
        unset($_SESSION['carrito'][$producto_id]);
    }
}

function manejarEliminarDelCarrito() {
    if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'eliminar') {
        $producto_id = $_GET['id'];
        eliminarDelCarrito($producto_id);
        echo "Producto eliminado del carrito";
        exit();
    }
}



?>
