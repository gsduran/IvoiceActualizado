<?php include 'cn.php';
//Actualiza en la BDD los datos del cliente

//Variables que reciben los datos del formulario
$idCliente = $_POST["idCliente"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$ciudad = $_POST["ciudad"];
$cod_postal = $_POST["cod_postal"];
$pais = $_POST["pais"];
$telefono = $_POST["telefono"];
$contacto = $_POST["contacto"];
$email_contacto = $_POST["emailContacto"];

//crear el update
$updateCliente = "UPDATE cliente SET 
                idCliente = '$idCliente',
                nombre = '$nombre',
                direccion = '$direccion',
                ciudad = '$ciudad',
                cod_postal = '$cod_postal',
                pais = '$pais',
                telefono = '$telefono',
                contacto = '$contacto',
                email_contacto = '$email_contacto'
                WHERE idCliente = '$idCliente'";

//Actualiza el Cliente
$actualizaCliente = mysqli_query($conexion, $updateCliente);


//cerrar conexion
if (!$actualizaCliente) {
    echo '<script>
    alert("Error al insertar");
    window.history.go(-1);
    </script>';
    exit;
} else {
    echo '<script>
    alert("El Cliente '.$nombre.' ha sido Actualizado exitósamente");
    exit();
    </script>';
    header("Location: ./clientes_mantenedor.php");
    
}
?>