<?php include "../../includes/php/header.php"; ?>
<?php
  $mysql=new mysqli('localhost','root','','kge');

$sql = "SELECT * FROM tbl_users";

if (isset($_POST['buscar'])) {
    $nombre = $_POST['nombre'];
    $sql = "SELECT * FROM tbl_users WHERE tx_nombre LIKE '%$nombre%' OR tx_apellidoPaterno LIKE '%$nombre%' OR tx_apellidoMaterno LIKE '%$nombre%' OR tx_correo LIKE '%$nombre%' OR tx_username LIKE '%$nombre%'";
}

if (isset($_POST['filtro'])) {
    $nombre = $_POST['nombre'];
    switch ($_POST['filtro']) {
        case 'M_todos':
            $sql = "SELECT * FROM tbl_users";
            break;
        case 'D_nombre':
            $sql = "SELECT * FROM tbl_users WHERE tx_nombre LIKE '%$nombre%'";
            break;
        case 'F_apellido':
            $sql = "SELECT * FROM tbl_users WHERE tx_apellidoPaterno LIKE '%$nombre%'";
            break;
    }
}

$query = mysqli_query($mysql, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTIVOS FIJOS</title>
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</head>

<body>
    <br>
    <div class="container-fluid position-relative d-flex p-4">
        <div class="col-sm-12">
            <h2 style="text-align: center;" id="titulo">ACTIVOS FIJOS SOLUTIONS</h2>
            <br>
            <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar"> Agregar</button>
            </div>
            <br>
            <div class="row">
                <div class="col-md-8" id="tabla1">
                    <?php
                    // Conexión a la base de datos (reemplaza con tus propias credenciales)
                    $conexion = new mysqli("localhost", "root", "", "kge");

                    if ($conexion->connect_error) {
                        die("Error en la conexión: " . $conexion->connect_error);
                    }

                    $result_categorias = $conexion->query("SELECT DISTINCT categoria FROM act_fijos WHERE activo = 1");

                    if ($result_categorias->num_rows > 0) {
                        while ($row_categoria = $result_categorias->fetch_assoc()) {
                            $categoria_actual = $row_categoria['categoria'];

                            echo "<div class=''>";
                            echo "<div class='card-body'>";
                            echo "<h6 class='color-categoria'>$categoria_actual</h6>";

                            $query = "SELECT id, codigo, marca, clave, serie, n_factura, usuarios, costo, factura, descripcion, imagen FROM act_fijos WHERE categoria = '$categoria_actual' && activo = 1";
                            $result_categoria = $conexion->query($query);

                            if ($result_categoria->num_rows > 0) {
                                echo "<div class='table-responsive'>";
                                echo "<table class='table text-start align-middle table-bordered table-hover mb-1 bg-secondary'>";
                                echo "<thead><tr class='text-white'>
                                            <th>Codigo</th>
                                            <th>Marca</th>
                                            <th>Clave</th>
                                            <th>Serie</th>
                                            <th>Número de factura</th>
                                            <th>Usuario</th>
                                            <th>Costo</th>
                                        </tr></thead>";
                                echo "<tbody>";

                                while ($fila = $result_categoria->fetch_assoc()) {
                                    echo "<tr class='fila-seleccionable' data-id='" . $fila['id'] . "' data-descripcion='" . $fila['descripcion'] . "' data-factura='" . $fila['factura']  . "' data-imagen='" . $fila['imagen'] ."'>";
                                    echo "<td>" . $fila['codigo'] . "</td>";
                                    echo "<td>" . $fila['marca'] . "</td>";
                                    echo "<td>" . $fila['clave'] . "</td>";
                                    echo "<td>" . $fila['serie'] . "</td>";
                                    echo "<td>" . $fila['n_factura'] . "</td>";
                                    echo "<td>" . $fila['usuarios'] . "</td>";
                                    echo "<td>" . $fila['costo'] . "</td>";
                                    echo "</tr>";
                                }

                                echo "</tbody>";
                                echo "</table>";
                                echo "</div>";
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
                            <div id="imagen" align="center"></div><br>

                            <p id="descripcion-producto" align="justify"></p>
                            <p id="existencia"></p>
                            <p id="fecha_adquisicion"></p>
                            <br>
                            <a class="btn btn-primary" id="btn-descargar" href="#">Descargar factura</a>
                            <a class="btn btn-warning" id="btn-editar" href="#">Editar</a>
                            <a class="btn btn-danger" id="btn-eliminar" href="#">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-center"> 
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col">
            <button type="button" class="btn btn-danger" onclick="location.href='../../includes/pdf/A_gpdf.php?activo=0'">Generar PDF</button>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".fila-seleccionable").click(function () {
                var id = $(this).data("id");
                var imagen = $(this).data("imagen");
                var descripcion = $(this).data("descripcion");
                var factura = $(this).data("factura");
                var n_factura = $(this).data("serie");

                $("#imagen").html("<img src='../../includes/img/" + imagen + "' alt='imagen' width='300px'>");
                $("#descripcion-producto").text(descripcion);
                $("#n_factura").text("Num de factura: " + existencia);
                $("#factura-producto").text("Factura: " + factura);
                $("#detalle-producto").data("id", id);
            });

            $("#btn-descargar").click(function () {
                var id = $("#detalle-producto").data("id");
                window.location.href = "../../includes/php/download.php?id=" + id;
            });

            $("#btn-editar").click(function () {
                var id = $("#detalle-producto").data("id");
                window.location.href = "../../includes/php/update.php?id=" + id;
            });

            $("#btn-eliminar").click(function () {
                var id = $("#detalle-producto").data("id");
                window.location.href = "../../includes/php/delete.php?id=" + id;
            });
        });
    </script>

</body> 
<footer>
<?php include "agregar.php"; ?> <br><br><br><br><br><br>
<?php include "../../includes/php/footer.php"; ?>


</footer>


</html>
