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
        <main>
            <div>
                <h1 class="text-center mt-5 fw-bold">Crée une annonce</h1>
            </div>
            <div class="formulaire container border rounded-4 mt-5">
                <form class="row g-3 p-5" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">titre</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["titre"] ?? '' ?></span>
                        <input type="text" name="titre" value="<?= $_POST["titre"] ?? "" ?>" class="form-control" id="inputAddress">
                    </div>
                    <div class="col-md-12">
                        <label for="description" class="form-label">description</label>
                        <textarea class="form-control" name="description" rows="3"><?= $_POST["description"] ?? "" ?></textarea>
                    </div>
                    <div class="col-12">
                        <input type="file" name="file" id="file">
                    </div>
                    <div>
                        <button class="uploader text-white px-3 rounded-5" type="submit">Uploader</button>
                    </div>
                </form>
            </div>
        </main>
    </main>
    <footer class="footer text-white text-center py-3 fixed-bottom">
        <?php include_once "template/footer.php" ?>
    </footer>
</body>

</html>