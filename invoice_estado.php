<?php include 'header.php'; ?>
<?php include 'cn.php'; ?>

<?php
//inicializacion de variables para caso por defecto
$filtroDefecto = '';
$filtroWhere = '';

// Si el post viene vacio carga fecha de hoy por defecto 
if (!empty($_POST["fechaInicio"]) and !empty($_POST["fechaFin"])) :
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"];
    $filtroWhere = "WHERE fecha BETWEEN " . "'$fechaInicio'" . " and " . "'$fechaFin'";
elseif (!empty($_POST) and !empty($_POST["idCliente"])) :
    $idCliente = $_POST["idCliente"];
    $filtroWhere = 'WHERE c.idCliente =' . $idCliente;
elseif (!empty($_POST) and !empty($_POST["numInvoice"])) :
    $idInvoice = $_POST["numInvoice"];
    $filtroWhere = 'WHERE i.idInvoice =' . $idInvoice;
else :
    $filtroDefecto = 'LIMIT 10';
endif;

?>

<div class="section container">
    <h5 class="blue-text text-darken-2">Buscar INVOICE Filtrando por fecha</h5>

    <div class="row">
        <!-- Buscador por ID Invoice -->
        <form method="POST" class="col s4 left">
            <div class="input field col s8">
                <label for="fecha">Ingresar N° de Invoice:</label>
                <input type="number" placeholder="N° Invoice" id="numInvoice" name="numInvoice" class="validate" required>
            </div>
            <div class="input field col s4">
                </br>
                <button class="btn-floating blue darken-3 waves-effect waves-light" type="submit" name="action">
                    <i class="material-icons right">search</i>
                </button>
            </div>
        </form>
        <!-- Filtro por rango de fechas -->
        <form method="POST" class="col s4 left">
            <div class="input field col s4">
                <label for="fecha">Desde:</label>
                <input type="text" class="datepickerInicio" id="fechaInicio" name="fechaInicio">
            </div>
            <div class="input field col s4">
                <label for="fecha">Hasta:</label>
                <input type="text" class="datepickerFin" id="fechaFin" name="fechaFin">
            </div>
            <div class="input field col s4">
                </br>
                <button class="btn-floating blue darken-3 waves-effect waves-light" type="submit" name="action">
                    <i class="material-icons right">search</i>
                </button>
            </div>
        </form>
        <!-- Filtro por Cliente -->
        <form method="POST" class="col s4">
            <div class="input field col s8">
                <label>Seleccionar Cliente:</label>
                <select name="idCliente" id="idCliente">
                    <option value="" selected>Listado de Clientes</option>
                    <?php
                    $sqlCli = "SELECT idCliente,nombre FROM cliente ORDER BY idCliente";
                    $resultado = mysqli_query($conexion, $sqlCli);

                    while ($lista = mysqli_fetch_array($resultado)) {
                    ?>
                        <option value="<?php echo $lista['idCliente'] ?>"><?php echo $lista["idCliente"] . ' - ' . $lista["nombre"] ?></option>
                    <?php
                    };
                    ?>
                </select>
            </div>
            <div class="input field col s4">
                </br>
                <button class="btn-floating blue darken-3 waves-effect waves-light" type="submit" name="action">
                    <i class="material-icons right">search</i>
                </button>
            </div>
        </form>
    </div>

    <h5 class="blue-text">Listado de Invoices
        <?php
        if (!empty($_POST["fechaInicio"]) and !empty($_POST["fechaFin"])) :
            echo '(' . $fechaInicio . ' al ' . $fechaFin . ')';
        elseif (!empty($_POST["idCliente"])) :
            echo ' - Cliente ID: ' . $idCliente;
        endif;
        ?>
    </h5>

    <table class="highlight centered" class="responsive-table" id="tablaInvoices">
        <thead>
            <tr>
                <th>ID Invoice</th>
                <th>Fecha</th>
                <th>Item</th>
                <th>Descripción</th>
                <th>Emisor</th>
                <th>Cliente</th>
                <th>Contacto</th>
                <th>Valor</th>
                <th>Total</th>
                <th>Estado de Pago</th>
                <th>Actualizar</th>
            </tr>
        </thead>
        <?php

        //Se ejecuta el SQL que se cargará a la tabla
        $sql = "SELECT i.idInvoice as idInvoice, i.fecha AS fecha, e.nombre AS nombreEmisor, c.nombre AS nombreCliente, c.contacto as contacto,
        d.valor as valor, est.descripcion as estadoPago, i.total as total, item.descripcion AS itemDescripcion, d.descripcion as itemDetalle
        FROM invoice i
        INNER JOIN cliente c ON i.idCliente = c.idCliente
        INNER JOIN emisor e ON i.idEmisor = e.idEmisor
        INNER JOIN estado est ON i.idEstado = est.idEstado
        INNER JOIN detalle d ON d.idInvoice = i.idInvoice
        INNER JOIN item ON item.idItem = d.idItem
        $filtroWhere
        ORDER BY idInvoice DESC $filtroDefecto";

        $resultado = mysqli_query($conexion, $sql);

        while ($lista = mysqli_fetch_array($resultado)) {
        ?>
            <tr>
                <td><?php echo $lista['idInvoice'] ?></td>
                <td><?php echo $lista['fecha'] ?></td>
                <td><?php echo $lista['itemDescripcion'] ?></td>
                <td><?php echo $lista['itemDetalle'] ?></td>
                <td><?php echo $lista['nombreEmisor'] ?></td>
                <td><?php echo $lista['nombreCliente'] ?></td>
                <td><?php echo $lista['contacto'] ?></td>
                <td><?php echo $lista['valor'] ?></td>
                <td><?php echo $lista['total'] ?></td>
                <td><?php echo $lista['estadoPago'] ?></td>
                <td>
                    <!-- Boton Actualizar -->
                    <form action="invoice_estado_actualiza.php" method="POST">
                        <button name="idInvoice" id="idInvoice" value="<?php echo $lista['idInvoice'] ?>" class="btn-floating waves-effect waves-light btn orange tooltipped" data-tooltip="Modificar Estado de Invoice N° <?php echo $lista['idInvoice'] ?>"><i class="material-icons right">sync</i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php
        };
        ?>

    </table>
    <div class="col-md-12 center text-center">
        <span class="left" id="total_reg"></span>
        <ul class="pagination pager" id="myPager"></ul>
    </div>
    <div>
        </br>
    </div>

</div>

<?php include 'footer.php'; ?>

<script>
    $(document).ready(function() {
        $('select').formSelect();
    });
</script>

<script>
    $(document).ready(function() {
        $('.fixed-action-btn').floatingActionButton();
    });
</script>

<script>
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth();
    var day = date.getDate();
    var date = new Date(year, month, day);
    var dateIni = new Date(year, (month - 1), day);

    $('.datepickerInicio').datepicker({
        autoClose: true,
        format: 'yyyy-mm-dd',
        defaultDate: dateIni,
        setDefaultDate: true
    });

    $('.datepickerFin').datepicker({
        autoClose: true,
        format: 'yyyy-mm-dd',
        defaultDate: date,
        setDefaultDate: true
    });
</script>

<script>
    $(document).ready(function() {
        $('.tooltipped').tooltip();
    });
</script>

<script type="text/javascript" src="js/pagination.js"></script>
<script>
    $(document).ready(function() {
        $('#tablaInvoices').pageMe({
            pagerSelector: '#myPager',
            activeColor: 'blue darken-3',
            prevText: 'Anterior',
            nextText: 'Siguiente',
            showPrevNext: true,
            hidePageNumbers: false,
            perPage: 10
        });
    });
</script>