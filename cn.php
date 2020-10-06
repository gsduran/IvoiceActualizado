<?php
$servidor = "localhost";
$usuario = "root";
$pass = "";
$db = "invoices";

$conexion = new mysqli($servidor, $usuario, $pass, $db);

if ($conexion->connect_error) {
die("Conexión fallida: " . $conexion->connect_error);
}

?>