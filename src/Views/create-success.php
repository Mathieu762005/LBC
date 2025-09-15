<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AFPA'nnonces</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coiny&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="d-flex flex-column vh-100">


    <header>
        <nav class="navbar navbar-expand-lg text-white">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-white fs-3" href="index.php?url=home">leboncoin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll d-flex align-items-center" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="index.php?url=annonces">Annonces</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="index.php?url=create">Crée</a>
                        </li>
                    </ul>
                    <form class="d-flex me-auto" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-light text-white" type="submit">Search</button>
                    </form>
                    <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll d-flex align-items-center" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="index.php?url=register">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="index.php?url=login">Connection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white fs-4" aria-current="page" href="index.php?url=profil"><i class="bi bi-person-circle"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main class="container py-4">

        <h1 class="text-center">C'est parti !!!</h1>

        <div class="row justify-content-center">

            <div class="col-6">

                <p>Votre inscription a bien été prise en compte, vous pouvez maintenant <a href="index.php?url=login">vous connecter</a>.</p>

            </div>

        </div>

    </main>


    <footer class="mt-auto text-center p-4 mt-3">
        <p class="m-0">Afpa - 2025 - MVC</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>