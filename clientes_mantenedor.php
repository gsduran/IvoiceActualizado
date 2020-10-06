<?php include 'header.php'; ?>
<?php include 'cn.php'; ?>

<div class="container section" id="todo">
    <h3 class="blue-text darken-2">Listado de Clientes</h3>
    <table class="highlight centered" class="responsive-table">
        <thead>
            <tr>
                <th>ID Cliente</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Código Postal</th>
                <th>País</th>
                <th>Teléfono</th>
                <th>Contacto</th>
                <th>Email</th>
                <th>Modificar</th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM cliente";
        $resultado = mysqli_query($conexion, $sql);

        while ($lista = mysqli_fetch_array($resultado)) {
        ?>
            <tr>
                <td><?php echo $lista['idCliente'] ?></td>
                <td><?php echo $lista['nombre'] ?></td>
                <td><?php echo $lista['direccion'] ?></td>
                <td><?php echo $lista['ciudad'] ?></td>
                <td><?php echo $lista['cod_postal'] ?></td>
                <td><?php echo $lista['pais'] ?></td>
                <td><?php echo $lista['telefono'] ?></td>
                <td><?php echo $lista['contacto'] ?></td>
                <td><?php echo $lista['email_contacto'] ?></td>
                <td>
                    <!-- Boton Modificar -->
                    <form action="cliente_actualiza.php" method="POST">
                        <button name="idCliente" id="idCliente" value="<?php echo $lista['idCliente'] ?>" class="btn-floating waves-effect waves-light btn orange tooltipped" data-tooltip="Modificar Cliente N° <?php echo $lista['idCliente'] ?>"><i class="material-icons right">sync</i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php
        };
        ?>

    </table>
</div>

<script src="js/jquery-3.5.1.min.js"></script>

<?php include 'footer.php'; ?>
<script>
    $(document).ready(function() {
        $('.tooltipped').tooltip();
    });
</script>