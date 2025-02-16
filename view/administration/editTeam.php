<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edición de equipo | Gestión Equipos | Francisco Javier Muñino Gil</title>
    <link rel="stylesheet" href="<?php echo BASE . "/assets/css/home.css"?>">
</head>
<body>
    <?php include __DIR__.'/../layout/header.php'; ?>
    <main id="main" class="mx-auto">
        <h1 class="title uppercase text-center">Edición de equipo</h1>
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
        <form action="<?php echo BASE ?>/administration/update-team/<?php echo $team->getId(); ?>" method="POST" class="base-form mx-auto">
            <div class="base-form__group">
                <label for="name" class="base-form__group__label">Nombre</label>
                <input type="text" name="name" id="name" required autocomplete="off" class="base-form__group__field" value="<?php echo $team->getName(); ?>">
            </div>
            <div class="base-form__group">
                <label for="city" class="base-form__group__label">Ciudad</label>
                <input type="text" name="city" id="city" required autocomplete="off" class="base-form__group__field" value="<?php echo $team->getCity(); ?>">
            </div>
            <div class="base-form__group">
                <label for="sport" class="base-form__group__label">Deporte</label>
                <select name="sport" id="sport" required class="base-form__group__field">
                    <option value="">-- Seleccione una opción --</option>
                    <?php
                    foreach(SPORTS as $sport){
                        if($team->getSport() === $sport){
                            echo "<option value='".$sport."' selected>".$sport."</option>";
                        }else{
                            echo "<option value='$sport'>$sport</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="base-form__group">
                <label for="yearOfFoundation" class="base-form__group__label">Fecha de fundación</label>
                <input type="date" name="year_of_foundation" id="yearOfFoundation" required autocomplete="off" class="base-form__group__field" value="<?php echo $team->getYearOfFoundation(); ?>">
            </div>
            <div class="base-form__group">
                <button class="save-button mx-auto" name="save">Actualizar</button>
            </div>
        </form>

    </main>
    <?php include  __DIR__.'/../layout/footer.php'; ?>
</body>
</html>