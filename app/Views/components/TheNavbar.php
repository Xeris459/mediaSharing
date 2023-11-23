<style>
    .modal.left .modal-dialog {
	position:fixed;
	right: 0;
	margin: auto;
	width: 320px;
	height: 100%;
	-webkit-transform: translate3d(0%, 0, 0);
	-ms-transform: translate3d(0%, 0, 0);
	-o-transform: translate3d(0%, 0, 0);
	transform: translate3d(0%, 0, 0);
}

.modal.left .modal-content {
	height: 100%;
	overflow-y: auto;
}

.modal.right .modal-body {
	padding: 15px 15px 80px;
}

.modal.right.fade .modal-dialog {
	left: -320px;
	-webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
	-moz-transition: opacity 0.3s linear, left 0.3s ease-out;
	-o-transition: opacity 0.3s linear, left 0.3s ease-out;
	transition: opacity 0.3s linear, left 0.3s ease-out;
}

.modal.right.fade.show .modal-dialog {
	right: 0;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <form action="<?= site_url('search') ?>" method="get" class="d-flex">
                <input class="form-control me-2" id="search" name="keyword" type="search" placeholder="Quick Search" aria-label="Search">
                <button class="btn btn-secondary me-2" data-toggle="modal" data-target="#exampleModal" type="button">Filter</button>
                <button class="btn btn-success" type="submit">Search</button>

                <div class="modal left fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <div class="modal-body">
                                <div class="nav flex-sm-column flex-row">
                                    <div class="text-secondary text-sm">Filter Category</div>
                                    <!-- checkbox -->
                                    <?php foreach ($category as $key =>$item) : ?>
                                        <div class="form-check">
                                            <input class="form-check-input category" name="category[]" type="checkbox" value="<?= $item->title ?>" id="defaultCheck<?= $key ?>">
                                            <label class="form-check-label" for="defaultCheck<?= $key ?>">
                                                <?= $item->title ?>
                                            </label>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <?php if (!auth()->loggedIn()) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('login') ?>">
                            <div class="btn btn-outline-light" type="submit">Login</div>
                        </a>
                    </li>
                <?php else : ?>
                    <!-- show user name -->
                    <!-- <li class="nav-item">
                        <div class="nav-link">
                            <div class="btn btn-outline-light disabled">
                                <?= auth()->user()->username ?>
                            </div>
                        </div>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('logout') ?>">
                            <div class="btn btn-outline-light" type="submit">Logout</div>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>  