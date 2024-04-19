<?php
include 'common.php';

inicializarHistorialPedidos();
global $productos;

include 'partials/header.php'
?>


<div class="container">
<div class="row">
<?php
// Mostrar historial de pedidos

if (empty($_SESSION['historial_pedidos'])) {
    echo '<div class="d-flex flex-column justify-content-center align-items-center vh-100">';
    echo '<p class="mensaje">No hay pedidos en el historial</p>';
    echo '</div>';
} else {
    foreach ($_SESSION['historial_pedidos'] as $pedido_id => $pedido) {
        echo '<div class="col-md-12 mb-4 mt-1">';
        echo '<div class="card shadow">';
        echo '<div class="card-body">';
        echo '<h2 class="card-title">Pedido: ' . ($pedido_id + 1) . '</h2>';

        foreach ($pedido as $producto_id => $cantidad) {
            if ($producto_id !== 'total') {
                echo '<p class="card-text">';
                echo 'Taza: ' . $productos[$producto_id]['nombre'];
                echo ' - Cantidad: ' . $cantidad;
                echo '<img src="' . $productos[$producto_id]['imagen'] . '" alt="imagen" style="width: 50px;">';
                echo '</p>';
            }
        }

        echo '<p class="fw-bold">Total pagado: $' . number_format($pedido['total'], 2) . '</p>'; // Imprime el total pagado

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

?>
</div>
</div>

<?php include 'partials/footer.php' ?>
