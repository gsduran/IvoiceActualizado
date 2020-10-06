<?php include 'header.php'; ?>
<?php include 'cn.php' ?>


<?php
if (!empty($_POST["idCliente"])) :
    $idCliente = $_POST["idCliente"];
    $sql = "SELECT * FROM cliente WHERE idCliente = $idCliente";
    $resultado = mysqli_query($conexion, $sql);
    while ($lista[] = $resultado->fetch_array());
endif
?>

<div class="section container">
    <h4 class="header left blue-text text-darken-3">Actualización de Datos de Clientes</h4>
    <div class="row">

        <form action="cliente_update.php" method="POST" class="col s12">
            <div class="row card-panel">
                <div class="input field col s12">
                    <div class="input field col s1">
                        <label for="idCliente">ID Cliente:</label>
                        <input value="<?php echo $lista[0]['idCliente'] ?>" type="text" id="idCliente" name="idCliente" class="validate center" readonly required>
                    </div>
                    <div class="input field col s11">
                        <label for="nombre">Nombre:</label>
                        <input value="<?php echo $lista[0]['nombre'] ?>" type="text" placeholder="Cliente o empresa" id="nombre" name="nombre" class="validate" required>
                    </div>

                    <div class="input field col s12">
                        <label for="direccion">Dirección:</label>
                        <input value="<?php echo $lista[0]['direccion'] ?>" type="text" placeholder="Ej: Los Boldos #12492" id="direccion" name="direccion" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="ciudad">Ciudad:</label>
                        <input value="<?php echo $lista[0]['ciudad'] ?>" type="text" placeholder="Ej: Santiago" id="ciudad" name="ciudad" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="cod_postal">Código Postal:</label>
                        <input value="<?php echo $lista[0]['cod_postal'] ?>" type="text" placeholder="FL 33660" id="cod_postal" name="cod_postal" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="pais">País:</label>
                        <input value="<?php echo $lista[0]['pais'] ?>" type="text" placeholder="Ej: Chile, USA, Taiwan, China" id="pais" name="pais" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="telefono">Teléfono:</label>
                        <input value="<?php echo $lista[0]['telefono'] ?>" type="text" placeholder="+56 9 99999999" id="telefono" name="telefono" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="contacto1">Contacto Principal:</label>
                        <input value="<?php echo $lista[0]['contacto'] ?>" type="text" placeholder="Contacto de la empresa" id="contacto" name="contacto" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="emailContacto">E-Mail Contacto:</label>
                        <input value="<?php echo $lista[0]['email_contacto'] ?>" type="email" placeholder="Correo corporativo contacto de la empresa" id="emailContacto" name="emailContacto">
                    </div>

                </div>
            </div>

            <button id="btnActualiza" class="btn-large orange darken-3 waves-effect waves-light" type="submit" name="action">Actualizar Datos Cliente
                <i class="material-icons right">person_add</i>
            </button>
        </form>

    </div>
</div>

</div>
<?php include 'footer.php'; ?>



