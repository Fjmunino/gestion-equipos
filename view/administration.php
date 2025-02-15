<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración | Gestión Equipos | Francisco Javier Muñino Gil</title>
    <link rel="stylesheet" href="assets/css/administration.css">
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <main id="main" class="mx-auto">
        <h1 class="title uppercase text-center">Administración de equipos</h1>
        <?php
        if(isset($successMessage)){
            ?>
            <div class="alert-success mx-auto">
                <?php echo $successMessage;?>
            </div>
            <?php
        }

        if(isset($errorValidation)){
            ?>
            <div class="alert-error mx-auto">
                <?php echo $errorValidation;    ?>
            </div>
            <?php
        }
        ?>
        <div>
            <?php
            if(empty($teams)){
                echo "<div class='alert-warning mx-auto'>No hay equipos registrados en el sistema.</div>";
            }else{
                ?>
                    <table class="team-table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Ciudad</th>
                            <th>Fecha de fundación</th>
                            <th>Deporte</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($teams as $team){
                                ?>
                                    <tr>
                                        <td><?php echo $team->getName(); ?></td>
                                        <td><?php echo $team->getCity(); ?></td>
                                        <td><?php echo (new DateTime($team->getYearOfFoundation()))->format('d/m/Y'); ?></td>
                                        <td><?php echo $team->getSport(); ?></td>
                                        <td>
                                            <a href="administration/edit-team/<?php echo $team->getId() ?>" class="team-table__action"><img src="assets/img/editar.png" alt="Editar equipo"></a>
                                            <form action="administration/delete-team/<?php echo $team->getId(); ?>" class="team-table__action delete-team" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $team->getId(); ?>">
                                                <button class="team-table__action__button">
                                                    <img src="assets/img/eliminar.png" alt="Eliminar equipo">
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                <?php
            }
            ?>

        </div>
    </main>
    <?php include 'layout/footer.php'; ?>

    <script>
        const options = document.querySelectorAll('.delete-team');
        options.forEach(element => {
            element.addEventListener('submit', function(e){
                e.preventDefault();
                if(confirm('¿Desea eliminar el equipo seleccionado? Esta acción será irreversible')){
                    element.submit();
                }
            });
        });
    </script>
</body>
</html>