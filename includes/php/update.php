<?php

include("../conexion/db.php");

$id=$_GET['id'];

$sql="SELECT * FROM act_fijos WHERE id='$id' ";
$query=mysqli_query($conexion,$sql);

$row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Actualizar Productos Fijos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #fff;
        }

        .form-container {
            background-color: #2c2c2c;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .form-control {
            background-color: #3c3c3c;
            color: #fff;
            border: none;
        }

        .form-control:focus {
            background-color: #4c4c4c;
            box-shadow: none;
        }

        .btn-warning {
            background-color: #af7c00;
            border-color: #af7c00;
        }

        .btn-danger {
            background-color: #a32020;
            border-color: #a32020;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h5 class="text-center mb-4">ACTUALIZAR PRODUCTOS FIJOS</h5>
                    <form action="edit.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <div class="mb-3">
                            <label for="codigo" class="form-label">Código:</label>
                            <input type="text" class="form-control" name="codigo" placeholder="Código" value="<?php echo $row['codigo'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca:</label>
                            <input type="text" class="form-control" name="marca" placeholder="Marca" value="<?php echo $row['marca'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="clave" class="form-label">Clave:</label>
                            <input type="text" class="form-control" name="clave" placeholder="Clave" value="<?php echo $row['clave'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <input type="text" class="form-control" name="descripcion" placeholder="Descripción" value="<?php echo $row['descripcion'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="serie" class="form-label">Serie:</label>
                            <input type="text" class="form-control" name="serie" placeholder="Serie" value="<?php echo $row['serie'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="usuarios" class="form-label">Usuarios:</label>
                            <input type="text" class="form-control" name="usuarios" placeholder="Usuarios" value="<?php echo $row['usuarios'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="costo" class="form-label">Costo $:</label>
                            <input type="text" class="form-control" name="costo" placeholder="Costo" value="<?php echo $row['costo'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="Numero de Factura" class="form-label">Número de Factura:</label>
                            <input type="text" class="form-control" name="Numero de Factura" placeholder="Número de Factura" value="<?php echo $row['n_factura'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría:</label>
                            <input type="text" class="form-control" name="categoria" placeholder="Categoría" value="<?php echo $row['categoria'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="lugar" class="form-label">Selecciona lugar:</label>
                            <select id="lugar" name="lugar" class="form-select" required>
                                <option value="Alta" <?php if ($row['lugar'] == 'Alta') echo 'selected'; ?>>Planta alta</option>
                                <option value="Baja" <?php if ($row['lugar'] == 'Baja') echo 'selected'; ?>>Planta baja</option>
                                <option value="Fuera" <?php if ($row['lugar'] == 'Fuera') echo 'selected'; ?>>Fuera de oficina</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning">Actualizar</button>
                            <a href="../../views/views_admin/index.php" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>