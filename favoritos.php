<?php
include 'common.php';

inicializarFavoritos();

include 'partials/header.php';
?>

<!-- mostrar productos en favoritos -->
<div class="container">
    <div class="row">
        <?php
        if (empty($_SESSION['favoritos'])) {
            echo '<div class="d-flex flex-column justify-content-center align-items-center vh-100">';
            echo '<p class="mensaje">No hay favoritos</p>';
            echo '</div>';
        } else {
            foreach ($_SESSION['favoritos'] as $producto_id => $favorito) {
                if ($favorito && isset($productos[$producto_id])) {
                    echo '<div class="col-md-3 mt-4">';
                    echo '<div class="card">';
                    echo '<img src="' . $productos[$producto_id]['imagen'] . '" alt="imagen" class="img-fluid w-100">';
                    echo '<div class="card-body">';
                    echo '<h2 class="card-title">' . $productos[$producto_id]['nombre'] . '</h2>';
                    echo '<p class="card-text fw-bold">$' . $productos[$producto_id]['precio'] . '</p>';
                    echo '<p class="btn btnAgregar" onclick="agregarAlCarrito(' . $producto_id . ')">Agregar al Carrito</p>';
                    echo '<a onclick="agregarAFavoritos(' . $producto_id . ')">';
                    echo '<i id="corazon-' . $producto_id . '" class="btn bi bi-heart-fill"></i>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        }
        ?>
    </div>
</div>

<?php include 'partials/footer.php'; ?>