<?php include 'cn.php';
//Actualiza en la BDD el estado del invoice

//Invoice y estado
$idEstado = $_POST["idEstado"];
$idInvoice = $_POST["idInvoice"];

//crear el update
$updateInvoice = "UPDATE invoice SET idEstado = $idEstado WHERE invoice.idInvoice = $idInvoice";

//Actualiza el estado
$actualizaEstado = mysqli_query($conexion, $updateInvoice);
