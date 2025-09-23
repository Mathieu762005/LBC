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
    <main class=" main flex-grow-1 pb-5">
        <div class="container mt-5 pb-5 bgBlanc">
            <div class="row align-items-center mx-auto">
                <div class="col-md-5">
                    <img class="img-fluid p-3 rounded-5 my-3" src="/uploads/<?= htmlspecialchars($annonces['a_picture']) ?>" alt="">
                    <p class="card-text text-black fs-2"><span class="fw-bold">Prix : </span><?= htmlspecialchars($annonces["a_price"]) ?> €</p>
                </div>
                <div class="col-md-6 row align-items-center">
                    <div class="description border rounded-3 p-3 mb-4 row">
                        <div>
                            <h1 class="text-black"><?= htmlspecialchars($annonces["u_username"]) ?></h1>
                        </div>
                        <div class="row ">
                            <h2 class="fs-1 text-black"><?= htmlspecialchars($annonces["a_title"]) ?></h2>
                            <p class="card-text text-black"><span class="fw-bold">Description : </span><?= htmlspecialchars($annonces["a_description"]) ?></p>
                            <p class="card-text text-black"><span class="fw-bold">Date de publication : </span><?= htmlspecialchars($annonces["a_publication"]) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer text-white text-end pe-3 py-3 fixed-bottom d-flex align-items-center justify-content-end">
        <?php include_once "template/footer.php" ?>
    </footer>
</body>

</html>