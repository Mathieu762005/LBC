<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AFPA'nnonces</title>

    <!-- cdn bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coiny&display=swap" rel="stylesheet">

    <!-- css perso -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- cdn icones bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body class="d-flex flex-column vh-100">

    <?php include_once __DIR__ . "/templates/navbar.php" ?>

    <main class="container flex-grow-1">
        <div class="row">

            <div class="col-12">
                <div class="row mt-3">
                    <?php foreach ($allAnnonces as $index => $annonce) {
                    ?>
                        <div class="col-lg-3 mb-4">
                            <a href="index.php?url=details/<?= $annonce['a_id'] ?>" class="text-decoration-none">
                                <div class="card h-100">
                                    <img src="/uploads/<?= $annonce['a_picture'] ?? 'no_picture.png' ?>" class="img-annonce" alt="Image aléatoire">

                                    <div class="card-body row">
                                        <div class="border p-2 col-10">
                                            <p class="card-title text-truncate"><?= $annonce['a_title'] ?></p>
                                            <p class="card-text fw-bold"><?= $annonce['a_price'] . '€' ?></p>
                                            <p class="m-0 text-secondary"><?= (new DateTime($annonce['a_publication']))->format('d/m/Y') ?></p>
                                        </div>
                                        <div class="border col-2 d-flex flex-column align-items-center justify-content-center p-2">
                                            <i class="bi bi-heart fs-3"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>

                <div class="text-center mb-4">
                    <a href="index.php?url=annonces" class="btn btn-success">Voir toutes les annonces</a>
                </div>

            </div>

        </div>
    </main>

    <?php include_once __DIR__ . "/templates/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>