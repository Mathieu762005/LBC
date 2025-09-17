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
                    <?php if (!isset($_SESSION['user'])): ?>
                        <a class="nav-link active text-white" aria-current="page" href="index.php?url=inscription">Inscription</a>
                    <?php endif; ?>
                </li>
                <a class="d-flex f-column align-items-center text-decoration-none" aria-current="page" href="<?= (isset($_SESSION['user'])) ? 'index.php?url=profil' : 'index.php?url=login' ?>">
                    <li class="nav-item text-white">
                        <?= (isset($_SESSION['user'])) ? $_SESSION['user']['username'] : 'connexion' ?>
                    </li>
                    <li class="nav-item text-white ps-2">
                        <i class="bi bi-person-circle fs-3"></i>
                    </li>
                </a>
            </ul>
        </div>
    </div>
</nav>