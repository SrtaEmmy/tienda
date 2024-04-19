<?php
include 'common.php';

inicializarCarrito();

agregarProductoAlCarrito();
manejarEliminarDelCarrito();

global $productos;

include 'partials/header.php'
?>

<h3>Carrito de Compras 
    <i class="bi bi-cart4 fs-1 " style="color: black;"></i>
</h3>

<!-- Mostrar cantidad de productos en el carrito -->
<?php
if(empty($_SESSION['carrito'])) {
    echo "<div class='d-flex flex-column justify-content-center align-items-center vh-100'>";
    echo "<p class='mensaje'>No hay nada en el carrito</p>";
    echo "<a class='btn btnAgregar' href='/../carrito/productos.php'>Seguir comprando</a>";
    echo "</div>";
} else {
    $total = 0;
    foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {
        $total += obtenerPrecioProducto($producto_id) * $cantidad;
        echo "<div class='container mt-4 mb-4'>";
        echo "<p>Taza {$productos[$producto_id]['nombre']} - Cantidad: <b>{$cantidad}</b></p>";
        echo "<img src='{$productos[$producto_id]['imagen']}' class='img-fluid w-25'/>";
        echo "<button onclick=\"eliminarDelCarrito({$producto_id})\">Eliminar</button>";
        echo "</div>";
    }
    echo "<div class='container ml-4'> <p>Total a pagar: <b>\${$total}</b></p> </div>";
    echo "<a class='btn btnAgregar m-4' href='pago.php'>Pagar</a>";
}
?>

<?php include 'partials/footer.php'?>
