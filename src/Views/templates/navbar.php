<div class="row justify-content-center m-0">

    <div class="col-10 border">
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow px-4 fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand coiny-regular" href="index.php">LeBonMarket</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="btn btn-warning" aria-current="page" href="index.php?url=create"><i class="bi bi-plus-circle me-2"></i>Déposer une annonce</a>
                        </li>
                    </ul>

                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Carte dracaufeu ... " aria-label="Search" />
                        <button class="btn btn-outline-success" type="button">Rechercher</button>
                    </form>

                    <a href="index.php?url=<?= isset($_SESSION["user"]) ? "profil" : "login" ?>" class="text-dark text-decoration-none">

                        <div class="d-flex flex-column justify-content-center text-center align-items-center navbar-connexion">
                            <i class="bi bi-person-fill my-profil"></i>
                            <div>
                                <?= $_SESSION["user"]["username"] ?? "Se connecter" ?>
                            </div>
                        </div>

                    </a>

                </div>
            </div>
        </nav>
    </div>

</div>