<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ;?>
    <?= $this->include('components/TheBanner') ?>
    <?= $this->include('components/TheNavbar') ?>
    

    <div class="container-fluid mt-4">
        <div class="row">
            <span class="fw-light text-muted text-center">Total Image <?= $totalImage ?></span>
        </div>
        <?php if (count($images) > 0) : ?>
            <div class="row" id="canvasGallery">
                <?= convertToGalleryCard($images) ?>
            </div>
        <?php else : ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> No Image Found
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if ($totalImage > $imagePerPage) : ?>
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-outline-primary" id="loadMore" onclick="loadMoreImage()">Load More ...</button>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>

    <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" style="width 100% !important">
            <div class="modal-content">
                <div class="row p-4">
                    <div class="col-7">
                        <div class="w-100">
                            <img src="https://publikasi-dam.jakarta.go.id/dokumentasi_pemprov_dki/api/v1/asset/2669538/preview" alt="" id="imageUrl" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-5 d-flex flex-column">
                        <a href='' id="singleDownloadModal" target='_blank' class='dropdown-item'><i class='fas fa-download text-muted p-2'></i> <span>Download</span></a>
                        <button onclick='modalAddButton(this)' class='dropdown-item' id="modalSelected" data-id=""><i class='fas fa-check text-muted p-2'></i> <span>Select</span></button>
                        <button class='dropdown-item'><i class='fas fa-share text-muted p-2'></i> <span>Share via link</span></button>

                        <hr class="bg-secondary">

                        <div class="mb-2">
                            <div class="text-muted text-xs">File Name</div>
                            <span class="font-weight-bold" id="fileName">nama_file.png</span>
                        </div>
                        <div class="mb-2">
                            <div class="text-muted text-xs">File Size</div>
                            <span class="font-weight-bold" id="fileSize">200 kb</span>
                        </div>
                        <div class="mb-2">
                            <div class="text-muted text-xs">Category</div>
                            <span class="badge bg-secondary" id="Category">Category</span>
                        </div>
                        <div class="mb-2">
                            <div class="text-muted text-xs">Description</div>
                            <p  id="fileDescription">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta unde necessitatibus tempora id nam aliquid consequuntur odio error? Similique nemo perspiciatis saepe molestiae asperiores aperiam est. Eveniet repellendus quibusdam libero!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ;?>

<?= $this->section('css') ;?>
<style>
    .text-xs {
        font-size: .8rem;
    }
    .top_image {
        display: flex;
        width: 100%;
        justify-content: space-between;
        align-items: center;
    }
    
    .container_image {
        padding: 1rem;
    }

    .image_title {
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .image_preview {
        width: 100%;
        max-height: 200px;
        overflow: hidden;
    }
    
    .image_preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: all 0.5s ease-in-out;
    }

    .image_description {
        max-height: 100px;
    }

    .flex {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #f5f5f5;
        border-radius: 5px;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
    }

    .flex:hover {
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
        scale: 1.02;
    }

    .flex:hover .image_preview {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
        scale: 1.01;
        padding: 0rem;
        transition: all 0.3s ease-in-out;
    }

    .image_icons {
        width: 100%;
        display: flex;
        justify-content: flex-end;
    }
</style>
<?= $this->endSection() ;?>

<?= $this->section('script') ;?>
    <script src="<?= site_url('assets/js/selected.js') ?>"></script>
<?= $this->endSection() ;?>
