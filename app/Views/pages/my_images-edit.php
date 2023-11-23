<?= $this->extend('layouts/dashboard'); ?>

<?=  $this->section('content') ?>
<h1 class="h3 mb-4 text-gray-800">Tambah Gambar Saya</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage Gambar</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="POST" action="<?= site_url('image/update') ?>" id="form" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id" value="<?= $data->id ?>">


                    <div class="modal-body" id="isi">
                        <div>
                            <img src="<?= site_url('images/' . $data->image) ?>" class="img-fluid" alt="Responsive image">
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" class="form-control-file" name="image" id="image"
                                        placeholder="" aria-describedby="fileHelpId">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select class="custom-select form-control" name="category" id="category">
                                        <?php foreach ($category as $item) : ?>
                                            <option value="<?= $item->title ?>" <?= $data->category_id == $item->id ? 'selected' : ''?>><?= $item->title ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"><?= $data->description ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('css') ;?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<?= $this->endSection() ;?>

<?= $this->section('script') ;?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<script type="text/javascript">
    $("#category").select2({
        theme: 'bootstrap4',
        tags: true,
        placeholder: "Select a category or create one",
    });
</script>
<?= $this->endSection() ;?>