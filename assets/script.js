// Función para mostrar alertas
function mostrarAlerta(mensaje) {
    // Crea la alerta
    var alerta = document.createElement("div");
    alerta.className = "alert alert-success";
    alerta.innerHTML = mensaje;

    var alertContainer = document.getElementById('alert-container');
    alertContainer.appendChild(alerta);

    // Oculta y elimina la alerta después de 3 segundos
    setTimeout(function() {
        alerta.style.display = "none";
        alertContainer.removeChild(alerta);
    }, 3000);
}

// AJAX [
function agregarAlCarrito(id) {
    // Realizar la solicitud AJAX al servidor
    fetch('productos.php?action=agregar&id=' + id)
        .then(response => response.text())
        .then(cantidadProductos => {
            // Actualizar dinámicamente la cantidad de productos en el carrito
            document.getElementById('cantidad-carrito').innerText = cantidadProductos;
    
            // Muestra alerta de agregado al carrito correctamente
            mostrarAlerta("Producto agregado al carrito");
        })
        .catch(error => console.error(error));
}

function agregarAFavoritos(id) {
    let corazon = document.querySelector('#corazon-' + id);
    let accion = corazon.classList.contains('bi-heart-fill') ? 'eliminarFavorito' : 'agregarFavorito';

    // Realizar la solicitud AJAX al servidor
    fetch('productos.php?action=' + accion + '&id=' + id)
        .then(response => response.text())
        .then(resultado => {
            // manejar la respuesta del servidor
            corazon.classList.toggle('bi-heart');
            corazon.classList.toggle('bi-heart-fill');
        })
        .catch(error => console.error(error));
}

function eliminarDelCarrito(id) {
    // Realizar la solicitud AJAX al servidor
    fetch('carrito.php?action=eliminar&id=' + id)
        .then(response => response.text())
        .then(resultado => {
            // Actualizar dinámicamente la página del carrito
            location.reload();
        })
        .catch(error => console.error(error));
}
// ]AJAX
