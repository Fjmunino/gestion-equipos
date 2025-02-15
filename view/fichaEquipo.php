<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fútbol | Gestión Equipos | Francisco Javier Muñino Gil</title>
    <link rel="stylesheet" href="<?php echo BASE . "/assets/css/public.css"?>"">
</head>
<body>
<?php include 'layout/header.php'; ?>
<main id="main" class="mx-auto">
    <h1 class="title uppercase text-center">Información del equipo</h1>
    <table class="team-information mx-auto mt20">
        <tbody>
            <tr>
                <td>Nombre</td>
                <td><?php echo $team->getName(); ?></td>
            </tr>
            <tr>
                <td>Ciudad</td>
                <td><?php echo $team->getCity(); ?></td>
            </tr>
            <tr>
                <td>Fecha de fundación</td>
                <td><?php echo (new DateTime($team->getYearOfFoundation()))->format('d/m/Y'); ?></td>
            </tr>
            <tr>
                <td>Deporte</td>
                <td><?php echo $team->getSport(); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="mt20 text-center">
        <a href="/gestion-equipos/<?php echo $sport; ?>">
            Volver al listado de equipos de <?php echo strtolower($team->getSport()); ?>
        </a>
    </div>
</main>
<?php include 'layout/footer.php'; ?>
</body>
</html>