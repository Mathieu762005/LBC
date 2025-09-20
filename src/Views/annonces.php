<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <?php include_once "template/navbar.php" ?>
    </header>
    <main>
        <div>
            <h1>Annonces Publiée</h1>
        </div>
        <div class="container">
            <div class="row">
                <?php foreach ($annonces as $annonce) { ?>
                    <div class="card" style="width: 18rem;">
                        <img src="<?= htmlspecialchars($annonce->a_picture) ?>" class="card-img-top"
                            alt="Image de l'annonce">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($annonce->a_title) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($annonce->a_description) ?></p>
                            <p class="card-text fw-bold"><?= htmlspecialchars($annonce->a_price) ?> €</p>
                            <a href="index.php?url=details&id=<?= $annonce->a_id ?>" class="btn btn-primary">Voir
                                l'annonce</a>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </main>
    <footer class="footer text-white text-center py-3 fixed-bottom">
        <?php include_once "template/footer.php" ?>
    </footer>
</body>

</html>