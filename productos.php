<?php
include 'common.php';

inicializarCarrito();
agregarProductoAlCarrito();
manejarAgregarYEliminarFavoritos();
global $productos;

$query = isset($_GET['query']) ? $_GET['query'] : '';

$productos = array_filter($productos, function ($producto) use ($query) {
    return strpos(strtolower($producto['nombre']), strtolower($query)) !== false;
});

include 'partials/header.php'
?>


<!-- formulario de busqueda -->
<nav class="navbar bg-yellow">
    <div class="container-fluid">
        <form class="d-flex" role="search" method="get" action="">
            <input class="form-control me-2" type="search" placeholder="Harry poter..." aria-label="Search" name="query">
            <button class="btn btnAgregar btn-outline-dark" type="submit">Search</button>
        </form>

    </div>
</nav>


<!-- Contenedor de alertas -->
<div id="alert-container" class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 5"> </div>



<!-- mostrar productos -->
<div class="container">
    <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4">
        <?php foreach ($productos as $producto_id => $producto) : ?>
            <div class="col m-3">
                <div class="card shadow">
                    <img src="<?php echo $producto['imagen']; ?>" alt="imagen" class="img-fluid w-100">
                    <div class="card-body card-product">
                        <h2 class="card-title"><?php echo $producto['nombre']; ?></h2>
                        <p class="card-text fw-bold">$<?php echo $producto['precio']; ?></p>
                        <p class="btn btnAgregar" onclick="agregarAlCarrito(<?php echo $producto_id; ?>)">Agregar al Carrito</p>
                        <a onclick="agregarAFavoritos(<?php echo $producto_id; ?>)">
                            <?php if (esFavorito($producto_id)) : ?>
                                <i id="corazon-<?php echo $producto_id; ?>" class="btn bi bi-heart-fill"></i>
                            <?php else : ?>
                                <i id="corazon-<?php echo $producto_id; ?>" class="btn bi bi-heart"></i>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>





<!-- Mostrar cantidad de productos en el carrito -->
<div class=" text-end pe-3 pt-5 ">
    <a class="d-inline-block bg-yellow carrito" href="carrito.php">
        <i class="bi bi-cart4 fs-1 " style="color: black;"></i>
        <span id="cantidad-carrito"><?php echo obtenerCantidadEnCarrito(); ?></span>
    </a>
</div>


<?php include 'partials/footer.php' ?>

