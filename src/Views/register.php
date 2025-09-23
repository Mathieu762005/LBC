<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include_once "template/navbar.php" ?>
    </header>
    <main class="flex-grow-1 main">
        <div>
            <h1 class="text-center mt-5 fw-bold">Inscription</h1>
        </div>
        <div class="formulaire container border rounded-4 bgBlanc mt-5">
            <form class="row g-3 p-5" method="POST" action="" novalidate>
                <div class="col-6">
                    <label for="inputAddress" class="form-label">E-mail</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["email"] ?? '' ?></span>
                    <input type="email" name="email" value="<?= $_POST["email"] ?? "" ?>" class="form-control" id="inputAddress">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Mot de passe</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["password"] ?? '' ?></span>
                    <input type="password" name="password" value="<?= $_POST["password"] ?? "" ?>" class="form-control" id="inputCity">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Comfirme ton mot de passe</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["confirmPassword"] ?? '' ?></span>
                    <input type="password" name="confirmPassword" value="<?= $_POST["confirmPassword"] ?? "" ?>" class="form-control" id="inputCity">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Prénom</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["username"] ?? '' ?></span>+
                    <input type="text" name="username" value="<?= $_POST["username"] ?? "" ?>" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="cgu" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            accepte les CGU
                        </label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["cgu"] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Confirmer mon inscription</button>
                </div>
                <a href="index.php?url=login">deja inscrit</a>
            </form>
        </div>
    </main>
    <footer class="footer text-white text-end pe-3 py-3 fixed-bottom d-flex align-items-center justify-content-end">
        <?php include_once "template/footer.php" ?>
    </footer>
</body>

</html>