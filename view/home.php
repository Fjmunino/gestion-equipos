<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión Equipos | Francisco Javier Muñino Gil</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <main id="main" class="mx-auto">
        <h1 class="title uppercase text-center">Listado de disciplinas</h1>
        <p class="text-center mt20">
            Seleccione una de las categorías que verá a continuación para visualizar el listado de equipos correspondiente.
        </p>
        <section class="sports-list">
            <div class="sports-list__inner">
                <article class="sports-list__inner__item">
                    <a href="futbol" class="sports-list__inner__item__link">
                        <div class="sports-list__inner__item__link__img">
                            <img src="assets/img/futbol.jpg" alt="Fútbol">
                        </div>
                        <h2 class="sports-list__inner__item__link__title text-center">
                            Fútbol
                        </h2>
                    </a>
                </article>
                <article class="sports-list__inner__item">
                    <a href="baloncesto" class="sports-list__inner__item__link">
                        <div class="sports-list__inner__item__link__img">
                            <img src="assets/img/baloncesto.jpg" alt="Baloncesto">
                        </div>
                        <h2 class="sports-list__inner__item__link__title text-center">
                            Baloncesto
                        </h2>
                    </a>
                </article>
                <article class="sports-list__inner__item">
                    <a href="rugby" class="sports-list__inner__item__link">
                        <div class="sports-list__inner__item__link__img">
                            <img src="assets/img/rugby.jpg" alt="Rugby">
                        </div>
                        <h2 class="sports-list__inner__item__link__title text-center">
                            Rugby
                        </h2>
                    </a>
                </article>
                <article class="sports-list__inner__item">
                    <a href="waterpolo" class="sports-list__inner__item__link">
                        <div class="sports-list__inner__item__link__img">
                            <img src="assets/img/waterpolo.jpg" alt="Waterpolo">
                        </div>
                        <h2 class="sports-list__inner__item__link__title text-center">
                            Waterpolo
                        </h2>
                    </a>
                </article>
            </div>
        </section>
    </main>
    <?php include 'layout/footer.php'; ?>
</body>
</html>