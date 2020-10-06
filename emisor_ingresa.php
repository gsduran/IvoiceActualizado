<?php include 'cn.php';

//Variables que reciben los datos del formulario
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$comuna = $_POST["comuna"];
$ciudad = $_POST["ciudad"];
$pais = $_POST["pais"];
$telefono = $_POST["telefono"];
$url = $_POST["url"];

//crear el insert
$insertar = "INSERT INTO emisor(`idEmisor`,`nombre`, `direccion`, `comuna`, `ciudad`, `pais`, `telefono`, `url`)
                        VALUES (default, '$nombre', '$direccion', '$comuna', '$ciudad', '$pais', '$telefono', '$url')";

//ejecutar la consulta
$resultado = mysqli_query($conexion, $insertar);

//cerrar conexion
if (!$resultado) {
    echo '<script>
    alert("Error al insertar");
    window.history.go(-1);
    </script>';
    echo $resultado;
    exit;
} else {
    echo '<script>
    alert("El Emisor '.$nombre.' ha sido ingresado exitósamente");
    window.history.go(-1);
    </script>';
    
}

?>