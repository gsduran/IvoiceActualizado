<?php include 'header.php'; ?>

<div class="section container">
    <h4 class="header left blue-text text-darken-3">Formulario de Ingreso de Clientes</h4>
    <div class="row">

        <form action="clientes_ingresa.php" method="POST" class="col s12">
            <div class="row card-panel">
                <div class="input field col s12">
                    <div class="input field col s12">
                        <label for="nombre">Nombre:</label>
                        <input type="text" placeholder="Cliente o empresa" id="nombre" name="nombre" class="validate" required>
                    </div>

                    <div class="input field col s12">
                        <label for="direccion">Dirección:</label>
                        <input type="text" placeholder="Ej: Los Boldos #12492" id="direccion" name="direccion" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="ciudad">Ciudad:</label>
                        <input type="text" placeholder="Ej: Santiago" id="ciudad" name="ciudad" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="cod_postal">Código Postal:</label>
                        <input type="text" placeholder="FL 33660" id="cod_postal" name="cod_postal" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="pais">País:</label>
                        <input type="text" placeholder="Ej: Chile, USA, Taiwan, China" id="pais" name="pais" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" placeholder="+56 9 99999999" id="telefono" name="telefono" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="contacto1">Contacto Principal:</label>
                        <input type="text" placeholder="Contacto de la empresa" id="contacto" name="contacto" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="emailContacto">E-Mail Contacto:</label>
                        <input type="email" placeholder="Correo corporativo contacto de la empresa" id="emailContacto" name="emailContacto">
                    </div>

                </div>
            </div>
            
            <button class="btn-large blue darken-3 waves-effect waves-light" type="submit" name="action">Agregar Nuevo Cliente
                <i class="material-icons right">person_add</i>
            </button>
        </form>

    </div>
</div>

<?php include 'footer.php'; ?>