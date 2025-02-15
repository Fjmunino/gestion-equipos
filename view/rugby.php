<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rugby | Gestión Equipos | Francisco Javier Muñino Gil</title>
    <link rel="stylesheet" href="assets/css/public.css">
</head>
<body>
<?php include 'layout/header.php'; ?>
<main id="main" class="mx-auto">
    <h1 class="title uppercase text-center">Listado de equipos de rugby</h1>
    <?php
        if(empty($teams)){
            ?>
                <div class="alert-warning mx-auto">
                    No hay equipos registrados en esta disciplina
                </div>
            <?php
        }else{
            ?>

            <table class="team-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($teams as $team){
                    ?>
                    <tr>
                        <td><?php echo $team->getName(); ?></td>
                        <td>
                            <a href="futbol/ficha-equipo/<?php echo $team->getSlug(); ?>" class="team-table__action">Ver ficha del equipo</a>
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

</main>
<?php include 'layout/footer.php'; ?>
</body>
</html>