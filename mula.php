<?php include 'header.php'; ?>
<?php include 'cn.php'; ?>

<div class="section container">
    <h4 class="header left blue-text text-darken-2">Emitir Nuevo INVOICE</h4>
    <div class="row">

        <form action="invoice_base_PDF.php" method="POST" class="col s12">
            <div class="row card-panel">
                <div class="input field col s4">
                    <label>Seleccionar EMISOR del INVOICE</label>
                    <select name="invoice" id="invoice">
                        <option value="" disabled selected>Lista de Emisores</option>
                        <?php
                        $sql = "SELECT idInvoice,fecha FROM invoice ORDER BY idInvoice DESC LIMIT 10";
                        $resultado = mysqli_query($conexion, $sql);

                        while ($lista = mysqli_fetch_array($resultado)) {
                        ?>
                            <option value="<?php echo $lista['idInvoice'] ?>"><?php echo 'Nº '.$lista['idInvoice'].' Con Fecha: '. $lista['fecha'] ?></option>
                        <?php
                        };
                        ?>
                    </select>
                </div>
                <!-- Boton hace PDF -->
                <button class="btn-large red darken-3 waves-effect waves-light" type="submit" name="action">PDF
                    <i class="material-icons right">person_add</i>
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    $(document).ready(function() {
        $('select').formSelect();
    });

    $(document).ready(function() {
        $('.modal').modal();
    });
</script>

<script>
    $(document).ready(function() {
        $('.fixed-action-btn').floatingActionButton();
    });
</script>