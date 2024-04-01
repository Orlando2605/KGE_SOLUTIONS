<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inactivar Producto</title>
<style>
  /* Estilos para la ventana emergente */
  .modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 0.5);
    padding: 20px;
    z-index: 1000;
  }

  .modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
  }

  .btn {
    background-color: #007bff;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
</style>
</head>
<body>

<!-- Botón para inactivar producto -->
<button class="btn" onclick="mostrarModal()">Inactivar Producto</button>

<!-- Ventana emergente -->
<div id="modal" class="modal">
  <div class="modal-content">
    <p>¿Estás seguro de que deseas inactivar este producto?</p>
    <button class="btn" onclick="inactivarProducto()" id="btn-eliminar">Sí, Inactivar</button>
    <button class="btn" onclick="cerrarModal()">Cancelar</button>
  </div>
</div>

<script>
// Función para mostrar la ventana emergente
function mostrarModal() {
  document.getElementById('modal').style.display = 'block';
}

// Función para cerrar la ventana emergente
function cerrarModal() {
  document.getElementById('modal').style.display = 'none';
}

// Función para inactivar el producto
function inactivarProducto() {
  // Aquí puedes agregar código para realizar la acción de inactivar el producto (por ejemplo, una solicitud AJAX)
  alert('Producto inactivado exitosamente.');
  window.location.href = 'delete.php?id=' + id; // Esto es solo un ejemplo, puedes reemplazarlo con tu lógica de inactivación real
  cerrarModal(); // Cerrar la ventana emergente después de inactivar el producto
}
</script>




<script>
        $(document).ready(function () {
            // Manejar clic en filas seleccionables
            $(".fila-seleccionable").click(function () {
                // Obtener datos de la fila seleccionada
                var id = $(this).data("id");
                var imagen = $(this).data("imagen")
                var descripcion = $(this).data("descripcion");
                var factura = $(this).data("factura");

                // Mostrar datos en el contenedor 2
                
                $("#imagen").html("<img src='../../includes/img/" + imagen + "' alt='imagen' width='300px'>");
        
                $("#descripcion-producto").text("Descripción: " + descripcion);
                $("#factura-producto").text("Factura: " + factura);

                // Almacenar ID en un atributo de datos del contenedor 2
                $("#detalle-producto").data("id", id);
            });

            // Redirigir a las páginas correspondientes al hacer clic en los botones
            $("#btn-descargar").click(function () {
                // Obtener el ID almacenado en el contenedor 2
                var id = $("#detalle-producto").data("id");

                // Redirigir a la página de descarga con el ID
                window.location.href = "../../includes/php/download.php?id=" + id;
            });

            $("#btn-editar").click(function () {
                // Obtener el ID almacenado en el contenedor 2
                var id = $("#detalle-producto").data("id");

                // Redirigir a la página de edición con el ID
                window.location.href = "../../includes/php/update.php?id=" + id;
            });

            $("#btn-eliminar").click(function () {
                // Obtener el ID almacenado en el contenedor 2
                var id = $("#detalle-producto").data("id");

                // Redirigir a la página de eliminación con el ID
                window.location.href = "delete.php?id=" + id;
            });
        });
    </script>

</body>
</html>
