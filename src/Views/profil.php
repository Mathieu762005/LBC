<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include_once "template/navbar.php" ?>
    </header>
    <main class="flex-grow-1 main pb-5">
        <div>
            <h1 class="text-center pt-4 pb-5 fs-1 fw-bold"><?= htmlspecialchars($_SESSION['user']['username']) ?></h1>
        </div>
        <div class="container">
            <div class="row">
                <?php foreach ($annonces as $annonce): ?>
                    <div class="col-md-2 mt-3">
                        <div class="card rounded-top-3 h-100 border-0 d-flex flex-column">
                            <a href="index.php?url=details/<?= $annonce['a_id'] ?>" class="text-decoration-none d-flex flex-column h-100">
                                <img src="/uploads/<?= htmlspecialchars($annonce['a_picture']) ?>" class="card-img-top rounded-3" alt="...">
                                <div class="card-body d-flex flex-column justify-content-end flex-grow-1">
                                    <h5 class="card-title text-black"><?= htmlspecialchars($annonce["a_title"]) ?></h5>
                                    <p class="card-text text-black"><?= htmlspecialchars($annonce["a_price"]) ?> €</p>
                                    <p class="card-text text-black"><?= htmlspecialchars($annonce["a_publication"]) ?></p>
                                    <a href="">delete</a>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <footer class="footer text-white text-end pe-3 py-3 d-flex align-items-center justify-content-end">
        <?php include_once "template/footer.php" ?>
    </footer>
</body>

</html>