<?= $this->extend('layouts/dashboard'); ?>

<?=  $this->section('content') ?>
<h1 class="h3 mb-4 text-gray-800">Tambah User</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="POST" action="<?= site_url('users/store') ?>" id="form" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <input type="hidden" name="id" id="id" value="">

                    <div class="modal-body" id="isi">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId"
                                        placeholder="" value="<?= old('username') ?>">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId"
                                        placeholder="" value="<?= old('email') ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Confirmation Password</label>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="helpId"
                                        placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select class="custom-select" name="role" id="role">
                                        <option></option>
                                        <?php foreach ($role as $key => $item) : ?>
                                            <option value="<?= $key ?>"><?= $key ?></option>
                                        <?php endforeach ?>
                                    </select>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<?= $this->endSection() ;?>

<?= $this->section('script') ;?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<script>
    $("#role").select2({
        theme: 'bootstrap4',
        placeholder: "Select a Role",
    });
</script>
<?= $this->endSection() ;?>