<?php
  $mysql=new mysqli('localhost','root','','kge');

  $sql="SELECT * FROM tbl_users";

  if (isset($_POST['buscar'])) {
    $nombre=$_POST['nombre'];
    $sql="SELECT * FROM tbl_users WHERE tx_nombre LIKE '%$nombre%' OR tx_apellidoPaterno LIKE '%$nombre%' OR tx_apellidoMaterno LIKE '%$nombre%' OR tx_correo LIKE '%$nombre%' OR tx_username LIKE '%$nombre%'";
  }

  if (isset($_POST['filtro'])){
    switch ($_POST['filtro']) {
        case 'M_todos':
        $sql="SELECT * FROM tbl_users";
      break;
        case 'D_nombre':
        $sql = "SELECT * FROM tbl_users WHERE tx_nombre LIKE '%$nombre%'";
      break;
        case 'F_apellido':
        $sql = "SELECT * FROM tbl_users WHERE tx_apellidoPaterno LIKE '%$nombre%'";
    }
  }
  $query=mysqli_query($mysql,$sql);
 
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
      top:30%; /* Ajusta la posición superior según tus necesidades */
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
            <h2 style="text-align: center;">PRODUCTOS DE ACTIVOS FIJOS ADMINISTRADOR</h2>
            <br>
            <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar"> Agregar
                </button>

                <a href="../users/user.php" class="btn btn-primary">Ir a usuarios</a>
                
                <a href="../products/products.php" class="btn btn-primary">Productos</a>
            </div>
            <br>
               <!---Terminar sesion--->
                <form action="../../includes/php/exit.php" method="post">
                    <input type="SUBMIT" value="Cerrar Sesi&oacute;n" />
                </form>
                             <!------->
            <br>

            <div class="row">
                <div class="col-md-8">
                    <?php
                    // Conexión a la base de datos (reemplaza con tus propias credenciales)
                    $conexion = new mysqli("localhost", "root", "", "kge");

                    // Verificar la conexión
                    if ($conexion->connect_error) {
                        die("Error en la conexión: " . $conexion->connect_error);
                    }

                    // Obtener categorías únicas de la base de datos
                    $result_categorias = $conexion->query("SELECT DISTINCT categoria FROM act_fijos");

                    // Verificar si hay resultados
                    if ($result_categorias->num_rows > 0) {
                        while ($row_categoria = $result_categorias->fetch_assoc()) {
                            $categoria_actual = $row_categoria['categoria'];

                            echo "<div class='card'>";
                            echo "<div class='card-body'>";
                            echo "<h4>$categoria_actual</h4>";

                            // Consultar elementos de la categoría actual
                            $query = "SELECT id, codigo, marca, clave, serie, existencia, usuarios, costo, factura, descripcion FROM act_fijos WHERE categoria = '$categoria_actual'";
                            $result_categoria = $conexion->query($query);

                            // Verificar si hay resultados
                            if ($result_categoria->num_rows > 0) {
                                echo "<table class='table table-hover'>";
                                echo "<thead><tr>
                                            <th>ID</th>
                                            <th>Codigo</th>
                                            <th>Marca</th>
                                            <th>Clave</th>
                                            <th>Serie</th>
                                            <th>Existencia</th>
                                            <th>Usuarios</th>
                                            <th>Costo $</th>
                                        </tr></thead>";
                                echo "<tbody>";

                                while ($fila = $result_categoria->fetch_assoc()) {
                                    echo "<tr class='fila-seleccionable' data-id='" . $fila['id'] . "' data-descripcion='" . $fila['descripcion'] . "' data-factura='" . $fila['factura'] . "'>";
                                    echo "<td>" . $fila['id'] . "</td>";
                                    echo "<td>" . $fila['codigo'] . "</td>";
                                    echo "<td>" . $fila['marca'] . "</td>";
                                    echo "<td>" . $fila['clave'] . "</td>";
                                    
                                    echo "<td>" . $fila['serie'] . "</td>";
                                    echo "<td>" . $fila['existencia'] . "</td>";
                                    echo "<td>" . $fila['usuarios'] . "</td>";
                                    echo "<td>" . $fila['costo'] . "</td>";
                                    echo "</tr>";
                                }

                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "No hay elementos en esta categoría.";
                            }

                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "No hay categorías disponibles.";
                    }

                    $conexion->close();
                    ?>
                </div>
                <div class="col-md-4 contenedor-fijo">
                    <div class="card">
                        <div class="card-body" id="detalle-producto">
                            <h4 class="text-center">Descripcion del producto</h4>
                            <p id="descripcion-producto"></p>
                            <p id="factura-producto"></p>
                            <br>
                            <a class="btn btn-primary" id="btn-descargar" href="#">Descargar</a>
                            <a class="btn btn-warning" id="btn-editar" href="#">Editar</a>
                            <a class="btn btn-danger" id="btn-eliminar" href="#">Eliminar</a>
                            
                        </div>
                    </div>
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

                // Mostrar datos en el contenedor 2
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
                window.location.href = "../../includes/php/delete.php?id=" + id;
            });
        });
    </script>

</body>
<?php include "agregar.php"; ?>

</html>
