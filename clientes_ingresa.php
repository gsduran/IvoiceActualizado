<?php include 'cn.php';

//Variables que reciben los datos del formulario
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$ciudad = $_POST["ciudad"];
$cod_postal = $_POST["cod_postal"];
$pais = $_POST["pais"];
$telefono = $_POST["telefono"];
$contacto1 = $_POST["contacto"];
$contacto2 = $_POST["emailContacto"];

//crear el insert
$insertar = "INSERT INTO cliente(`idCliente`, `nombre`, `direccion`, `ciudad`, `cod_postal`, `pais`, `telefono`, `contacto`, `email_contacto`)
                        VALUES (default, '$nombre', '$direccion', '$ciudad', '$cod_postal', '$pais', '$telefono', '$contacto1', '$contacto2')";

//verificar usuario


//ejecutar la consulta
$resultado = mysqli_query($conexion, $insertar);

//cerrar conexion
if (!$resultado) {
    echo '<script>
    alert("Error al insertar");
    window.history.go(-1);
    </script>';
    exit;
} else {
    echo '<script>
    alert("El Cliente '.$nombre.' ha sido ingresado exitósamente");
    window.history.go(-1);
    </script>';
    
}

?>