<?php include 'cn.php';

//recuperar el ID de invoice recien ingresado
$recuperaIdInvoice = "SELECT idInvoice FROM invoice ORDER BY idInvoice DESC LIMIT 1";
$resultado = mysqli_query($conexion, $recuperaIdInvoice);
$fila = mysqli_fetch_row($resultado);
$idInvoice = $fila[0];

$filas = json_decode($_POST['valores'], true);

$stmt = $conexion->prepare("INSERT INTO detalle(
        idDetalle,
        idInvoice,
        idItem,
        descripcion,
        valor
    ) VALUES (
        default,
        $idInvoice,
        ?,
        ?,
        ?
    )");

$stmt->bind_param('isi', $item, $descripcion, $valor);

$inserciones = 0;
foreach ($filas as $fila) {
    $itemDescripcion = $fila['item'];
    
    //recuperar el ID del item segun descripcion para insertar el ID en la bdd
    $recuperaIdItem = "SELECT idItem FROM item where descripcion = '$itemDescripcion'";
    $resultadoItem = mysqli_query($conexion, $recuperaIdItem);
    $filaItem = mysqli_fetch_row($resultadoItem);
    $idItem = $filaItem[0];

    $item = $idItem;
    $descripcion = $fila['descripcion'];
    $valor = $fila['valor'];
    $result = $stmt->execute();
    if ($result) {
        $inserciones++;
    }
}

//actualizar invoice

// realiza el calculo de los items, los suma y guarda en variable totalItems
$calculaTotal = "SELECT sum(valor) from detalle where idInvoice = $idInvoice";
$resultadoTotal = mysqli_query($conexion, $calculaTotal);
$filaTotal = mysqli_fetch_row($resultadoTotal);
$totaItems = $filaTotal[0];

// Actualiza el invoice con al suma del total
$updateTotalInvoice = "UPDATE invoice SET total = $totaItems WHERE invoice.idInvoice = $idInvoice";
$actualizaTotal = mysqli_query($conexion,$updateTotalInvoice);

?>