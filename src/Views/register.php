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

    <main class="container py-4">

        <h1 class="text-center">Inscription</h1>

        <div class="row justify-content-center">

            <div class="col-6">

                <form action="index.php?url=register" method="POST" novalidate>

                    <div class="mb-3">
                        <label for="username" class="form-label">Pseudo</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["username"] ?? '' ?></span>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $_POST["username"] ?? "" ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse mail</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["email"] ?? '' ?></span>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $_POST["email"] ?? "" ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["password"] ?? '' ?></span>
                        <input type="password" class="form-control" id="password" name="password" value="<?= $_POST["password"] ?? "" ?>">
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirmation du mot de passe</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["confirmPassword"] ?? '' ?></span>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="<?= $_POST["confirmPassword"] ?? "" ?>">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="cgu" name="cgu">
                        <label class="form-check-label" for="cgu">J'ai lu et j'accepte les CGU</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["cgu"] ?? '' ?></span>
                    </div>

                    <button type="submit" class="btn btn-primary">S'inscrire</button>

                    <a class="d-block mt-2" href="index.php?url=login">Déjà inscrit ? Je me connecte !</a>
                    <span class="ms-2 text-danger fst-italic fw-light"><?= $errors["server"] ?? '' ?></span>

                </form>

            </div>

        </div>

    </main>

    <?php include_once __DIR__ . "/templates/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>