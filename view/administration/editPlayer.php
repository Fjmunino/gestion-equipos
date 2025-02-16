<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edición de jugador | Gestión Equipos | Francisco Javier Muñino Gil</title>
    <link rel="stylesheet" href="<?php echo BASE . "/assets/css/administration.css"?>">
</head>
<body>
<?php include __DIR__.'/../layout/header.php'; ?>
<main id="main" class="mx-auto">
    <h1 class="title uppercase text-center">Edición de jugador en equipo <?php echo $team->getName(); ?></h1>

    <?php if(isset($successMessage)){
        ?>
        <div class="alert-success mx-auto">
            <?php echo $successMessage; ?>
        </div>
        <?php
    }
    ?>
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
    <form action="<?php echo BASE ?>/administration/update-player/<?php echo $player->getId(); ?>" method="POST" class="base-form mx-auto">
        <div class="base-form__group">
            <label for="name" class="base-form__group__label">Nombre</label>
            <input type="text" name="name" id="name" required class="base-form__group__field" value="<?php echo $player->getName(); ?>">
            <small class="field-validation name-validation hidden">Debe completar el campo "nombre"</small>
        </div>
        <div class="base-form__group">
            <label for="surname" class="base-form__group__label">Apellidos</label>
            <input type="text" name="surname" id="surname" required class="base-form__group__field" value="<?php echo $player->getSurname(); ?>">
            <small class="field-validation name-validation hidden">Debe completar el campo "apellidos"</small>
        </div>
        <div class="base-form__group">
            <label for="number" class="base-form__group__label">Dorsal</label>
            <input type="text" name="number" id="number" required class="base-form__group__field" value="<?php echo $player->getNumber(); ?>">
            <small class="field-validation name-validation hidden">Debe completar el campo "dorsal"</small>
        </div>
        <div class="base-form__group">
            <label for="birth" class="base-form__group__label">Fecha de nacimiento</label>
            <input type="date" name="birth" id="birth" required class="base-form__group__field" value="<?php echo $player->getBirth(); ?>">
            <small class="field-validation name-validation hidden">Debe seleccionar una fecha de nacimiento</small>
        </div>
        <div class="base-form__group form-group-check">
            <input type="checkbox" name="captain" id="captain" class="base-form__group__field"<?php if($player->getCaptain()) echo "checked"; ?>>
            <label for="captain" class="base-form__group__label">Capitán del equipo</label>
            <small class="field-validation name-validation hidden">Debe seleccionar una fecha de nacimiento</small>
        </div>
        <div class="base-form__group">
            <button class="save-button mx-auto" name="save">Actualizar</button>
        </div>
    </form>
</main>
<?php include  __DIR__.'/../layout/footer.php'; ?>
<!--<script src="--><?php //echo BASE . "/assets/js/teamValidation.js"?><!--"></script>-->
</body>
</html>