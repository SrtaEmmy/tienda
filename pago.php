<?php
include 'common.php';


// Redirigir si el carrito está vacío y mostrar alerta
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<div class='alert alert-success' id='myAlert'>
            Pago realizado correctamente. Serás redirijido a la página principal.
          </div>
          <script type='text/javascript'>
            setTimeout(function(){
              document.getElementById('myAlert').style.display = 'none';
              window.location.href = 'productos.php';
            }, 3000);
          </script>";
    exit();
}



$total_pagar = 0;
foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {
    // Obtener el precio real del producto desde el array de productos
    $precio_producto = obtenerPrecioProducto($producto_id);
    $total_pagar += $precio_producto * $cantidad;
}

// Guardar el total pagado antes de limpiar el carrito
$total_pagado = $total_pagar;

// Agregar el carrito al historial de pedidos antes de limpiarlo
$_SESSION['carrito']['total'] = $total_pagado;
$_SESSION['historial_pedidos'][] = $_SESSION['carrito'];

// Limpiar el carrito después de realizar el pago 
$_SESSION['carrito'] = [];

include 'partials/header.php';
?>

<h3>Resumen de compra</h3>

<?php
foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {
    echo "<div>";
    echo "<p>Producto ID: {$producto_id} - Cantidad: {$cantidad}</p>";
    echo "</div>";
}
?>


<form action="" method="post">
    <!-- pago simulado -->
    <div class="d-flex flex-column justify-content-center align-items-center vh-100">
        <p class="fw-bold">Total a pagar: $<?php echo number_format($total_pagado, 2); ?></p>
        <input class="btn btnAgregar " type="submit" value="Realizar Pago">
    </div>
</form>

<?php include 'partials/footer.php'; ?>