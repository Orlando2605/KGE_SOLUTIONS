<?php
// Evitar cacheo de página
#header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
#header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado

// Si no hay una sesión iniciada, redireccionar al inicio o a donde desees
#if (!isset($_SESSION['usuario'])) {
#    header("Location: ../../index.php");
#    exit;
#}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
      height: 150vh; /* Esto es solo para crear suficiente contenido y permitir desplazamiento */
      margin: 0;
      padding: 0;
    }

    .contenedor-fijo {
      position: fixed;
      top:80%; /* Ajusta la posición superior según tus necesidades */
      left: 65%; /* Ajusta la posición izquierda según tus necesidades */
      background-color: #f0f0f0;
      padding: 10px;
      border: 1px solid #ccc;
    }
  </style>
    <title>ARCHIVOS FIJOS ADMINISTRADOR</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
        crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp"
        crossorigin="anonymous">

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</head>

<body>
    <br>

    <div class="container">
        <div class="col-sm-12">
            <h2 style="text-align: center;">PRODUCTOS GENERALES</h2>
            <br>
            <div>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#agregar">Agregar</button>

                <a href="../users/user.php" class="btn btn-success">Ir a usuarios</a>
                
                <a href="../views_admin/index.php" class="btn btn-primary">Activos fijos</a>
            </div>
            <br>
               <!---Terminar sesion--->
                <form action="../../includes/php/exit.php" method="post">
                    <input type="SUBMIT" value="Cerrar Sesi&oacute;n" />
                </form>
                             <!------->
            <br>

            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Conexión a la base de datos (reemplaza con tus propias credenciales)
                    $conexion = new mysqli("localhost", "root", "", "kge");

                    // Verificar la conexión
                    if ($conexion->connect_error) {
                        die("Error en la conexión: " . $conexion->connect_error);
                    }

                    // Obtener categorías únicas de la base de datos
                    $result_categorias = $conexion->query("SELECT DISTINCT grupo FROM products");

                    // Verificar si hay resultados
                    if ($result_categorias->num_rows > 0) {
                        while ($row_categoria = $result_categorias->fetch_assoc()) {
                            $categoria_actual = $row_categoria['grupo'];

                            
                            echo "<div class='table-responsive'>";
                            echo "<h4>$categoria_actual</h4>";

                            // Consultar elementos de la categoría actual
                            $query = "SELECT id, clave, marca, clave, modelo, unidad, num_parte, descripcion, presentacion, grupo, tipo, precio, imagen, notas, factura FROM products WHERE grupo = '$categoria_actual'";
                            $result_categoria = $conexion->query($query);

                            // Verificar si hay resultados
                            if ($result_categoria->num_rows > 0) {
                                echo "<table class='table table-striped table-dark table_id' padding='10px'>";
                                echo "<thead><tr>
                                            <th>Clave</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Unidad</th>
                                            <th>N° de parte</th>                                     
                                            <th>Presentación</th>
                                            <th>Grupo</th>
                                            <th>Tipo</th>
                                            <th>Precio</th>
                            
                                        </tr></thead>";
                                echo "<tbody>";

                                while ($fila = $result_categoria->fetch_assoc()) {
                                    echo "<tr class='fila-seleccionable' data-id='" . $fila['id'] . "' data-descripcion='" . $fila['descripcion'] . "' data-factura='" . $fila['factura'] . "'>";
                                  
                                    echo "<td>" . $fila['clave'] . "</td>";
                                    echo "<td>" . $fila['marca'] . "</td>";
                                    echo "<td>" . $fila['modelo'] . "</td>";                      
                                    echo "<td>" . $fila['unidad'] . "</td>";
                                    echo "<td>" . $fila['num_parte'] . "</td>";                                  
                                    echo "<td>" . $fila['presentacion'] . "</td>";
                                    echo "<td>" . $fila['grupo'] . "</td>";
                                    echo "<td>" . $fila['tipo'] . "</td>";                      
                                    echo "<td>" . $fila['precio'] . "</td>";
                                    echo "</tr>";
                                }

                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "No hay elementos en esta categoría.";
                            }

                            echo "</div>";
                        }
                    } else {
                        echo "No hay categorías disponibles.";
                    }

                    $conexion->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Manejar clic en filas seleccionables
            $(".fila-seleccionable").click(function () {
                // Obtener datos de la fila seleccionada
                var id = $(this).data("id");
                var descripcion = $(this).data("descripcion");
                var factura = $(this).data("factura");

                // Abrir una nueva ventana con los detalles del producto
                window.open("detalle_producto.php?id=" + id, "_blank");
            });
        });
    </script>

</body>

<?php include "add_product.php"; ?>

</html>
