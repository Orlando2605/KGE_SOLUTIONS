<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .producto-image {
            text-align: center;
            margin-bottom: 20px;
        }

        .producto-image img {
            max-width: 100%;
            height: auto;
        }

        .producto-detalles {
            margin-bottom: 20px;
        }

        .producto-detalles p {
            margin: 0 0 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        // Verificar si se ha proporcionado un ID de producto
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];

            // Conexión a la base de datos
            $conexion = new mysqli("localhost", "root", "", "kge");

            // Verificar conexión
            if ($conexion->connect_error) {
                die("Error en la conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener los detalles del producto según el ID proporcionado
            $sql = "SELECT * FROM products WHERE id = $producto_id";
            $resultado = $conexion->query($sql);

            // Verificar si se encontró el producto
            if ($resultado->num_rows > 0) {
                $producto = $resultado->fetch_assoc();

                // Mostrar detalles del producto
                echo "<div class='producto-image'>";
                echo "<img src='../../includes/img/{$producto['imagen']}' alt='Imagen del Producto' width='400px' heigth='70'>";
                echo "</div>";

                echo "<div class='producto-detalles'>";
                echo "<h2>Detalles del Producto</h2>";
                echo "<p><strong>ID:</strong> {$producto['id']}</p>";
                echo "<p><strong>Clave:</strong> {$producto['clave']}</p>";
                echo "<p><strong>Marca:</strong> {$producto['marca']}</p>";
                echo "<p><strong>Modelo:</strong> {$producto['modelo']}</p>";
                echo "<p><strong>Unidad:</strong> {$producto['unidad']}</p>";
                echo "<p><strong>Número de Parte:</strong> {$producto['num_parte']}</p>";
                echo "<p><strong>Descripción:</strong> {$producto['descripcion']}</p>";
                echo "<p><strong>Presentación:</strong> {$producto['presentacion']}</p>";
                echo "<p><strong>Grupo:</strong> {$producto['grupo']}</p>";
                echo "<p><strong>Tipo:</strong> {$producto['tipo']}</p>";
                echo "<p><strong>Precio:</strong> {$producto['precio']}</p>";
                echo "<p><strong>Notas:</strong> {$producto['notas']}</p>";
                echo "<p><strong>Factura:</strong> {$producto['factura']}</p>";
                echo "</div>";
            } else {
                echo "<p>Producto no encontrado.</p>";
            }

            // Cerrar conexión
            $conexion->close();
        } else {
            echo "<p>No se ha proporcionado un ID de producto.</p>";
        }
        ?>
    </div>

</body>

</html>
