<?php include 'header.php'; ?>
<?php include 'cn.php'; ?>

<div class="container section">
    <h3 class="blue-text darken-2">Listado de Emisores</h3>
    <table class="highlight centered" class="responsive-table">
        <thead>
            <tr>
                <th>ID Emisor</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Comuna</th>
                <th>Cuidad</th>
                <th>País</th>
                <th>Teléfono</th>
                <th>URL</th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT idEmisor, nombre, direccion, comuna, ciudad,
                     pais, telefono, url FROM emisor";
        $resultado = mysqli_query($conexion, $sql);

        while ($lista = mysqli_fetch_array($resultado)) {
        ?>
            <tr>
                <td><?php echo $lista['idEmisor'] ?></td>
                <td><?php echo $lista['nombre'] ?></td>
                <td><?php echo $lista['direccion'] ?></td>
                <td><?php echo $lista['comuna'] ?></td>
                <td><?php echo $lista['ciudad'] ?></td>
                <td><?php echo $lista['pais'] ?></td>
                <td><?php echo $lista['telefono'] ?></td>
                <td><?php echo $lista['url'] ?></td>
            </tr>
        <?php
        };
        ?>

    </table>

</div>

<?php include 'footer.php'; ?>