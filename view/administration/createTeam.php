<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta de equipo | Gestión Equipos | Francisco Javier Muñino Gil</title>
    <link rel="stylesheet" href="<?php echo BASE . "/assets/css/administration.css"?>">
</head>
<body>
    <?php include __DIR__.'/../layout/header.php'; ?>
    <main id="main" class="mx-auto">
        <h1 class="title uppercase text-center">Alta de equipo</h1>

        <?php
            if(isset($errorValidation)){
                ?>
                <div class="alert-error mx-auto">
                    <div>Se han encontrado los siguientes errores de validación:</div>
                    <ul>
                        <?php
                        if(is_array($errorValidation)){
                            foreach($errorValidation as $error){
                                echo "<li>".$error."</li>";
                            }
                        }else{
                            echo "<strong>".$errorValidation."</strong>";
                        }

                        ?>
                    </ul>
                </div>

        <?php
            }
        ?>
        <form action="create-team-post" method="POST" class="base-form mx-auto">
            <div class="base-form__group">
                <label for="name" class="base-form__group__label">Nombre</label>
                <input type="text" name="name" id="name" required class="base-form__group__field">
                <small class="field-validation name-validation hidden">Debe completar el campo "nombre"</small>
            </div>
            <div class="base-form__group">
                <label for="city" class="base-form__group__label">Ciudad</label>
                <input type="text" name="city" id="city" required class="base-form__group__field">
                <small class="field-validation city-validation hidden">Debe completar el campo "ciudad"</small>
            </div>
            <div class="base-form__group">
                <label for="sport" class="base-form__group__label">Deporte</label>
                <select name="sport" id="sport" required class="base-form__group__field">
                    <option value="">-- Seleccione una opción --</option>
                    <?php
                        foreach(SPORTS as $sport){
                            echo "<option value='$sport'>$sport</option>";
                        }
                    ?>
                </select>
                <small class="field-validation sport-validation hidden">Debe seleccionar un "deporte"</small>
            </div>
            <div class="base-form__group">
                <label for="yearOfFoundation" class="base-form__group__label">Fecha de fundación</label>
                <input type="date" name="year_of_foundation" required id="yearOfFoundation"  class="base-form__group__field">
                <small class="field-validation year_of_foundation-validation hidden">Debe seleccionar una "fecha de fundación"</small>
            </div>
            <div class="base-form__group">
                <button class="save-button mx-auto" name="save">Guardar</button>
            </div>
        </form>
    </main>
    <?php include  __DIR__.'/../layout/footer.php'; ?>
    <script src="<?php echo BASE . "/assets/js/teamValidation.js"?>"></script>
</body>
</html>