<?php include 'header.php'; ?>

<div class="section container">
    <h4 class="header left blue-text text-darken-3">Formulario de Ingreso de Emisores</h4>
    <div class="row">

        <form action="emisor_ingresa.php" method="POST" class="col s12">
            <div class="row card-panel">
                <div class="input field col s12">
                    <div class="input field col s12">
                        <label for="nombre">Nombre:</label>
                        <input type="text" placeholder="Empresa o persona natural" id="nombre" name="nombre" class="validate" required>
                    </div>

                    <div class="input field col s12">
                        <label for="direccion">Dirección:</label>
                        <input type="text" placeholder="Ej: Los Boldos #12492" id="direccion" name="direccion" class="validate" required>
                    </div>
                    
                    <div class="input field col s6">
                        <label for="comuna">Comuna:</label>
                        <input type="text" placeholder="Ej: El Bosque" id="comuna" name="comuna" class="validate" required>
                    </div>

                    <div class="input field col s6">
                        <label for="ciudad">Ciudad:</label>
                        <input type="text" placeholder="Ej: Santiago" id="ciudad" name="ciudad" class="validate" required>
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
                        <label for="url">URL:</label>
                        <input type="text" placeholder="www.mywebsite.com" id="url" name="url" class="validate" required>
                    </div>
                </div>
            </div>
            
            <button class="btn-large blue darken-3 waves-effect waves-light" type="submit" name="action">Agregar Nuevo Emisor
                <i class="material-icons right">person_add</i>
            </button>
        </form>

    </div>
</div>

<?php include 'footer.php'; ?>