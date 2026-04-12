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
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- cdn icones bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body class="d-flex flex-column vh-100">

    <?php include_once __DIR__ . "/templates/navbar.php" ?>

    <main class="container flex-grow-1">

        <div>
            <a href="index.php?url=home" class="btn btn-outline-primary btn-sm mt-3">Retour aux annonces</a>
        </div>

        <hr>

        <div class="row mt-3 mb-4">

            <div class="col-lg-8 border rounded p-3">
                <img src="/uploads/<?= $annonce["a_picture"] ?? 'no_picture.png' ?>" class="img-detail" alt="Image de l'annonce">
                <div class="mt-2 border border rounded py-2 px-3 shadow shadow-sm">
                    <p class="text-secondary">Publié le : <?= (new DateTime($annonce["a_publication"]))->format('d/m/Y') ?></p>
                    <p class="h3"><?= $annonce["a_title"] ?></p>
                    <p class="mt-2 h5"><?= $annonce["a_price"] . ' €' ?></p>
                </div>
                <div class="mt-2 p-2">
                    <p class="mt-1 h4">Description</p>
                    <p class="mt-3 text-secondary"><?= $annonce["a_description"] ?></p>
                </div>
            </div>

            <div class="col-lg-4 rounded p-3">
                <div class="mb-4">
                    <div class="row">
                        <div class="col-3 text-center">
                            <i class="bi bi-person-circle display-1"></i>
                        </div>
                        <div class="col h3 pt-2">
                            <?= $annonce["u_username"] ?>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-warning w-100 my-1">Acheter</button>
                    <button class="btn btn-outline-primary w-100 my-1">Faire une offre</button>
                    <button class="btn btn-primary w-100 my-1">Contacter</button>
                    <?php if (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $annonce["u_id"]) { ?>
                        <div class="mt-4 border border-secondary rounded p-3">
                            <a href="index.php?url=edit/<?= $annonce["a_id"] ?>" class="btn btn-secondary w-100 my-1">Modifier</a>
                            <a href="#" class="btn btn-danger w-100 my-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer</a>
                        </div>

                        <!-- Modal de confirmation -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Supprimer</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Vous souhaitez supprimer : <b><?= $annonce["a_title"] ?></b>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <form action="index.php?url=delete/<?= $annonce["a_id"] ?>" method="POST">
                                            <button class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>

        <!-- <div class="row mt-3">

            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="/uploads/<?= $annonce["a_picture"] ?? 'no_picture.png' ?>" class="img-annonce" alt="Image de l'annonce">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $annonce["a_title"] ?></h5>
                        <p class="card-text"><?= $annonce["a_price"] . ' €' ?></p>
                    </div>
                </div>
            </div>

        </div> -->

    </main>

    <?php include_once __DIR__ . "/templates/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>