<?php include 'header.php'; ?>
<?php include 'cn.php' ?>

<?php
if (!empty($_POST["idInvoice"])) :
    $idInvoice = $_POST["idInvoice"];
    $sqlEstado = "SELECT est.idEstado, est.descripcion as estadoPago
                  FROM invoice i
                  INNER JOIN estado est ON i.idEstado = est.idEstado
                  WHERE i.idInvoice = $idInvoice";

    $EstadoActual = mysqli_query($conexion, $sqlEstado);
    $fila = mysqli_fetch_row($EstadoActual);
    $estado = $fila[1];
endif;
?>

<div class="container section">
    <h4 class="blue-text darken-2">Actualización de Estado de Pago</h4>
    <h5>Invoice N° <?php echo $idInvoice ?></h5>
    <h5>Estado actual es: <?php echo $estado ?></h5>
    <!-- Carga lista de estados -->
    <div class="row">
        <form>
            <div class="input field col s4">
                <label>Cambiar Estado a:</label>
                <select name="idEstado" id="idEstado" require>
                    <option value="">Seleccione estado</option>
                    <?php
                    $sqlEstado = "SELECT idEstado,descripcion FROM estado ORDER BY idEstado";
                    $resultado = mysqli_query($conexion, $sqlEstado);

                    while ($lista = mysqli_fetch_array($resultado)) {
                    ?>
                        <option value="<?php echo $lista['idEstado'] ?>"><?php echo $lista["idEstado"] . ' - ' . $lista["descripcion"] ?></option>
                    <?php
                    };
                    ?>
                </select>
            </div>
            <div class="input field col s4">
                </br>
                <button id="btnActualiza" onclick="cambiaEstado(<?php echo $idInvoice ?>,idEstado.value)" class="btn-floating green darken-3 waves-effect waves-light">
                    <i class="material-icons right">check</i>
                </button>
            </div>
        </form>

    </div>
</div>

</div>
<?php include 'footer.php'; ?>
<script>
    $(document).ready(function() {
        $('select').formSelect();
    });
</script>

<script>
    $('#btnActualiza').click(function(e) {
        // prevent click action
        e.preventDefault();
        // your code here
        return false;
    });
</script>

<script src="js/alertify.min.js"></script>
<script>
    function cambiaEstado(idInv, idEst) {
        if (idInv && idEst) {
            alertify.confirm("Actualización de estado de Invoice N°" + idInv, "¿Desea cambiar el Estado de Pago?",

                function() {
                    $.ajax({
                        type: "POST",
                        url: "invoice_estado_update.php",
                        data: {
                            idInvoice: idInv,
                            idEstado: idEst,
                        },
                        async: false
                    });
                    //alertify.success('¡Actualizado!');
                    window.location.href = "invoice_estado.php";
                },
                function() {
                    alertify.error('Cancelado');
                    $.ajax({
                        type: "POST",
                        url: "invoice_estado.php",
                        data: {
                            idInvoice: idInv,
                            idEstado: idEst,
                        },
                        async: false
                    });
                    
                }).set('labels', {
                ok: 'OK',
                cancel: 'Cancelar'
            }, );

        }
    }
</script>