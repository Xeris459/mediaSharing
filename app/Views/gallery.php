<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ;?>
    <?= $this->include('components/TheBanner') ?>
    <?= $this->include('components/TheNavbar') ?>
    

    <div class="container mt-4">
        <div class="row">
            <span class="fw-light text-muted text-center">Total Image 299</span>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

                    <div class="card-body">
                        <div class="card-text text-muted mb-2">Category</div>
                        <p class="card-text">
                            This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                        </p>
                        <div class="d-flex justify-content-end align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fa-solid fa-arrow-down"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ;?>

<?= $this->section('script') ;?>
    <script src="<?= site_url('assets/js/selected.js') ?>"></script>
<?= $this->endSection() ;?>
