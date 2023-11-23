<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ;?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<div class="row">
    <div class="col-12">
        <div class="alert alert-info" role="alert">
            Selamat Datang <b><?= auth()->user()->username ?></b> di Media Sharing
        </div>
    </div>

    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Informasi</h6>
            </div>
            <div class="card-body">
                <p>
                    Media Sharing adalah sebuah website yang memungkinkan pengguna untuk mengunggah gambar dan
                    membagikannya kepada pengguna lainnya.
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ;?>
