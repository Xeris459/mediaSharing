<?= $this->extend('backend/layout/content'); ?>

<?=  $this->section('content') ?>
<form method="POST" action="<?= base_url('/admin/meta/save') ?>" id="form" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= (isset($setting['id'])) ? $setting['id'] : '' ?>">
    <div class="row mb-4 ">
        <div class="col-12  d-flex flex-row-reverse">
            <button class="btn btn-primary">Save Setting</button>
        </div>
    </div>
    <div class="row">
        <!-- website logo -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Website Banner Default
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 no">
                            <div class="form-group">
                                <label for="">Website Logo</label>
                                <input type="file" class="form-control-file" name="image" id="image" placeholder=""
                                    aria-describedby="fileHelpId">
                                <small id="fileHelpId" class="form-text text-muted">maximum file size is 2MB and only
                                    support jpg, jpeg and png</small>
                            </div>
                        </div>
                        <div class="col-6 m-auto">
                            <img src="<?= (isset($setting['image'])) ? $setting['image'] : $default ?>"
                                class="rounded mx-auto d-block" alt="ini icon web" style="max-width:100%;">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    This image will appear as a preview when sharing the link on other websites (for whatsapp max size
                    is 300kb)
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Basic Information
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Default Deskription</label>
                                <textarea class="form-control" name="desk" id="desk" rows="3"
                                    maxlength="200"><?= (isset($setting['desk'])) ? $setting['desk'] : '' ?></textarea>
                                <small>max 200 character</small>
                            </div>

                            <div class="form-group">
                                <label for="">Tag</label>
                                <textarea class="form-control" name="tag" id="tag"
                                    rows="3"><?= (isset($setting['tag'])) ? $setting['tag'] : '' ?></textarea>
                                <small>separate with commas (,)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?> ?>