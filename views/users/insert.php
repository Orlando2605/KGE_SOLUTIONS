<?php
include("../../includes/conexion/db.php");


$id=$_POST['id'];
$tx_nombre=$_POST['tx_nombre'];
$tx_apellidoPaterno=$_POST['tx_apellidoPaterno'];
$tx_apellidoMaterno=$_POST['tx_apellidoMaterno'];
$tx_correo=$_POST['tx_correo'];
$tx_username=$_POST['tx_username'];
$tx_password=$_POST['tx_password'];
$id_tipousuario=$_POST['id_tipousuario'];

$sql="INSERT INTO tbl_users VALUES ('$id','$tx_nombre','$tx_apellidoPaterno','$tx_apellidoMaterno',
'$tx_correo','$tx_username','$tx_password','$id_tipousuario', now() ) ";
$query= mysqli_query($conexion,$sql); 

/*

      #buscardor repetidor
function BuscaRepetido ($user,$pass,$con){
    $sql = "SELECT * FROM id_usuarios where id_usuario ='$user' and tx_password ='$pass'";
    $result = mysqli_query($con,$sql);

    if(mysql_num_rows($result)  > 0){
        return 1;
    }else{
        return 0;
    }


}
*/
if($query){
    header("Location: user.php");

}else{

}
?>