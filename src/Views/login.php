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

<body>
    <header>
        <?php include_once "template/navbar.php" ?>
    </header>
    <main>
        <div>
            <h1 class="text-center mt-5 fw-bold">Connection</h1>
        </div>
        <div class="formulaire container border rounded-4 mt-5">
            <form class="row g-3 p-5" method="POST" action="" novalidate>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">E-mail</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["email"] ?? '' ?></span>
                    <input type="email" name="email" value="<?= $_POST["email"] ?? "" ?>" class="form-control" id="inputAddress">
                </div>
                <div class="col-md-12">
                    <label for="inputCity" class="form-label">Mot de passe</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["password"] ?? '' ?></span>
                    <input type="password" name="password" value="<?= $_POST["password"] ?? "" ?>" class="form-control" id="inputCity">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Connection</button>
                    <span class="ms-2 text-danger fst-italic fw-light"><?= $errors["connexion"] ?? '' ?></span>
                </div>
                <a href="index.php?url=register">pas encore inscrit</a>
            </form>
        </div>
    </main>
    <footer class="footer text-white text-center py-3 fixed-bottom">
        <?php include_once "template/footer.php" ?>
    </footer>
</body>

</html>