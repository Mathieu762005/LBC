<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeBonMarket</title>

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

        <h1 class="text-center">Mon annnonce</h1>

        <div class="row justify-content-center">

            <div class="col-6">

                <form action="index.php?url=create" method="POST" enctype="multipart/form-data" novalidate>

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["title"] ?? '' ?></span>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $_POST["title"] ?? "" ?>">
                    </div>

                    <div class="mb-3">
                        <label for="picture" class="form-label">Photo (optionnel)</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["picture"] ?? '' ?></span>
                        <input class="form-control" type="file" id="picture" name="picture" onchange="previewPicture(this)">
                        <img src="#" alt="" id="image" style="max-width: 500px; margin-top: 2rem; max-height: 500px; display: block;">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["description"] ?? '' ?></span>
                        <textarea class="form-control" id="description" name="description" rows="3"><?= $_POST["description"] ?? "" ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Prix</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["price"] ?? '' ?></span>
                        <!-- ici le prix sera en text pour faciliter le traitement et également l'affichage -->
                        <input type="text" class="form-control" id="price" name="price" value="<?= $_POST["price"] ?? "" ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre en ligne</button>

                    <a class="btn btn-secondary" href="index.php">Annuler</a>
                    <span class="ms-2 text-danger fst-italic fw-light"><?= $errors["creation"] ?? '' ?></span>

                </form>

            </div>

        </div>

    </main>

    <?php include_once __DIR__ . "/templates/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script type="text/javascript">
        // L'image img#image
        let image = document.querySelector("#image");

        // La fonction previewPicture
        let previewPicture = function(e) {

            // e.files contient un objet FileList
            const [picture] = e.files

            // "picture" est un objet File
            if (picture) {

                // L'objet FileReader
                let reader = new FileReader();

                // L'événement déclenché lorsque la lecture est complète
                reader.onload = function(e) {
                    // On change l'URL de l'image (base64)
                    image.src = e.target.result
                }

                // On lit le fichier "picture" uploadé
                reader.readAsDataURL(picture)

            }
        }
    </script>
</body>

</html>