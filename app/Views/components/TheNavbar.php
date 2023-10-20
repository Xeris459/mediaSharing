<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Quick Search" aria-label="Search">
                <li class="nav-item dropdown btn btn-secondary me-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-gear"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <button class="btn btn-success" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <div class="nav-link">
                        <button class="btn btn-outline-light disabled" id="downloadMultipleButton" type="submit">
                            (0) Download
                            <i class="fa-solid fa-arrow-down"></i>
                        </button>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('login') ?>">
                        <div class="btn btn-outline-light" type="submit">Login</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>  