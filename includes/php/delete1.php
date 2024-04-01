<?php

include("../conexion/db.php");
#Capturar los datos con get por medio del id para despues eliminar
$id=$_GET['id'];

$sql="UPDATE act_fijos SET activo = 0 WHERE id='$id'";
$query=mysqli_query($conexion,$sql);
#Si todo sale bien me actualizará datos en la misma ventana
    if($query){


        if ($conexion->query($sql) === TRUE) {
            echo "El producto ha sido desactivado exitosamente.";
            header("Location: ../../views/views_admin/index.php");
        } else {
            echo "Error al desactivar el producto: " . $conexion->error;
        }
        
        
    }
?>