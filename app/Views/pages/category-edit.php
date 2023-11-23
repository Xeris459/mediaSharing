<?= $this->extend('layouts/dashboard'); ?>

<?=  $this->section('content') ?>
<h1 class="h3 mb-4 text-gray-800">Edit Category</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage Category</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="POST" action="<?= site_url('category/update') ?>" id="form" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <input type="hidden" name="id" id="id" value="<?= $data->id ?>">

                    <div class="modal-body" id="isi">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Category Title</label>
                                    <input type="text" class="form-control" name="category" id="category" aria-describedby="helpId"
                                        placeholder="" value="<?= $data->title ?>">
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
<?= $this->endSection() ;?>

<?= $this->section('script') ;?>
<?= $this->endSection() ;?>