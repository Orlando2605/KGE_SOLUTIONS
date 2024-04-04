<?php

$host = "sql109.infinityfree.com";
$user = "if0_36301317";
$password = "orlandogomez260502";
$database = "if0_36301317_kge";


$conexion = mysqli_connect($host, $user, $password, $database);
if(!$conexion){
echo "No se realizo la conexion a la base de datos, el error fue:".
mysqli_connect_error() ;


}

?>