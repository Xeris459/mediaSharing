<?= $this->extend('backend/layout/content'); ?>

<?=  $this->section('content') ?>
<div class="p-3 mb-2 bg-info text-white">Setting Still in Delevopment, only affects a few pages during the development
    period</div>

<form method="POST" action="<?= base_url('/admin/setting/save') ?>" id="form" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= (isset($setting['id'])) ? $setting['id'] : '' ?>">
    <div class="row mb-4 ">
        <div class="col-12  d-flex flex-row-reverse">
            <button class="btn btn-primary">Save Setting</button>
        </div>
    </div>
    <div class="row">
        <!-- website logo -->
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Website Logo
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 no">
                            <div class="form-group">
                                <label for="">Website Logo</label>
                                <input type="file" class="form-control-file" name="logo" id="logo" placeholder=""
                                    aria-describedby="fileHelpId">
                                <small id="fileHelpId" class="form-text text-muted">maximum file size is 2MB and only
                                    support jpg, jpeg and png (recomended)</small>
                            </div>
                        </div>
                        <div class="col-6 m-auto">
                            <img src="<?= (isset($setting['logo'])) ? $setting['logo'] : $default ?>"
                                class="rounded mx-auto d-block" alt="ini icon web"
                                style="max-width:140px; max-height:140px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- website icon -->
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Website Icon
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 no">
                            <div class="form-group">
                                <label for="">Website Icon</label>
                                <input type="file" class="form-control-file" name="icon" id="icon" placeholder=""
                                    aria-describedby="fileHelpId">
                                <small id="fileHelpId" class="form-text text-muted">maximum file size is 2MB and only
                                    support jpg, jpeg and png (recomended)</small>
                            </div>
                        </div>
                        <div class="col-6 m-auto">
                            <img src="<?= (isset($setting['icon'])) ? $setting['icon'] : $default ?>"
                                class="rounded mx-auto d-block" alt="ini icon web"
                                style="max-width:140px; max-height:140px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Email Setting & Media Social
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Recipient Email</label>
                                <input type="email" class="form-control" name="email_admin" aria-describedby="helpId"
                                    placeholder=""
                                    value="<?= (isset($setting['email_admin'])) ? $setting['email_admin'] : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">sender email</label>
                                <input type="email" class="form-control" name="email_sender" aria-describedby="helpId"
                                    placeholder=""
                                    value="<?= (isset($setting['email_sender'])) ? $setting['email_sender'] : '' ?>">
                            </div>
                            <hr>
                            <!-- <div class="form-group">
                                <label for="">Facebook</label>
                                <input type="text" class="form-control" name="facebook" aria-describedby="helpId"
                                    placeholder=""
                                    value="<?= (isset($setting['facebook'])) ? $setting['facebook'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Twitter</label>
                                <input type="text" class="form-control" name="twitter" aria-describedby="helpId"
                                    placeholder=""
                                    value="<?= (isset($setting['twitter'])) ? $setting['twitter'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Instagram</label>
                                <input type="text" class="form-control" name="instagram" aria-describedby="helpId"
                                    placeholder=""
                                    value="<?= (isset($setting['instagram'])) ? $setting['instagram'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Youtube</label>
                                <input type="text" class="form-control" name="youtube" aria-describedby="helpId"
                                    placeholder=""
                                    value="<?= (isset($setting['youtube'])) ? $setting['youtube'] : '' ?>">
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Setting Contact
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    aria-describedby="helpId" placeholder=""
                                    value="<?= (isset($setting['phone'])) ? $setting['phone'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input type="text" class="form-control" name="fax" id="fax" aria-describedby="helpId"
                                    placeholder="" value="<?= (isset($setting['fax'])) ? $setting['fax'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="loc">Address</label>
                                <textarea class="form-control" name="address" id="address"
                                    rows="3"><?= (isset($setting['address'])) ? $setting['address'] : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="loc">Location (Google Map Iframe)</label>
                                <textarea class="form-control" name="loc" id="loc"
                                    rows="3"><?= (isset($setting['loc'])) ? $setting['loc'] : '' ?></textarea>
                            </div>
                            <!-- <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="check" id="check" value="1"
                                        <?= (isset($setting['check'])) ? $setting['check'] : '' ?>>
                                    Save to Database
                                </label>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>