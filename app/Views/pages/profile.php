<?= $this->extend('layouts/dashboard'); ?>

<?=  $this->section('content') ?>

<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-5">
    <div class="card profile-widget">
        <div class="profile-widget-header">
            <img alt="image" src="<?= $auth->getImage() ?>" class="rounded-circle profile-widget-picture">
            <div class="profile-widget-items">
                <div class="profile-widget-item">
                    <div class="profile-widget-item-label">Total Image</div>
                    <div class="profile-widget-item-value"><?= $totalImages ?></div>
                </div>
                <div class="profile-widget-item">
                    <div class="profile-widget-item-label">Category Created</div>
                    <div class="profile-widget-item-value"><?= $totalCategories ?></div>
                </div>
            </div>
        </div>
        <div class="profile-widget-description">
            <div class="profile-widget-name d-flex align-items-center font-weight-bold">
                <?= $auth->username ?>
                <div class="text-muted d-inline font-weight-normal d-flex align-items-center">
                    <div class="slash"></div>
                    <?= join(',', $auth->getGroups()) ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-12 col-md-12 col-lg-7">
    <div class="card">
        <form method="post" action="<?= site_url('profile/update') ?>" class="needs-validation" novalidate="" enctype="multipart/form-data">
          <div class="card-header">
              <h4>Edit Profile</h4>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-12">
                      <div class="form-group">
                          <label for="">Avatar</label>
                          <input type="file" class="form-control-file" name="image" id="image"
                              placeholder="" aria-describedby="fileHelpId">
                      </div>
                  </div>
              </div>

              <input type="hidden" name="id" value="<?= $auth->id ?>">

              <div class="row">
                  <div class="form-group col-md-6 col-12">
                      <label>Username</label>
                      <input type="text" name="username" class="form-control" value="<?= $auth->username ?>" required="">
                  </div>
                  <div class="form-group col-md-6 col-12">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" value="<?= $auth->email ?>" required="">
                  </div>
              </div>

              <div class="row">
                  <div class="form-group col-md-6 col-12">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control">
                      <small>Please leave this one if you are not intended to change password for this user</small>
                  </div>
                  <div class="form-group col-md-6 col-12">
                      <label>Confirmation Password</label>
                      <input type="password" name="confirm_password" class="form-control">
                  </div>
              </div>
          </div>
          <div class="card-footer text-right">
              <button class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<style>
.slash:after {
  content: " / ";
  padding: 0 10px;
}
.profile-widget {
  margin-top: 35px;
}
.profile-widget .profile-widget-picture {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
  float: left;
  width: 100px;
  margin: -35px -5px 0 30px;
  position: relative;
  z-index: 1;
}
.profile-widget .profile-widget-header {
  display: inline-block;
  width: 100%;
  margin-bottom: 10px;
}
.profile-widget .profile-widget-items {
  display: flex;
  position: relative;
}
.profile-widget .profile-widget-items:after {
  content: " ";
  position: absolute;
  bottom: 0;
  left: -25px;
  right: 0;
  height: 1px;
  background-color: #f2f2f2;
}
.profile-widget .profile-widget-items .profile-widget-item {
  flex: 1;
  text-align: center;
  border-right: 1px solid #f2f2f2;
  padding: 10px 0;
}
.profile-widget .profile-widget-items .profile-widget-item:last-child {
  border-right: none;
}
.profile-widget .profile-widget-items .profile-widget-item .profile-widget-item-label {
  font-weight: 600;
  font-size: 12px;
  letter-spacing: 0.5px;
  color: #34395e;
}
.profile-widget .profile-widget-items .profile-widget-item .profile-widget-item-value {
  color: #000;
  font-weight: 600;
  font-size: 16px;
}
.profile-widget .profile-widget-description {
  padding: 20px;
  line-height: 26px;
}
.profile-widget .profile-widget-description .profile-widget-name {
  font-size: 16px;
  margin-bottom: 10px;
  font-weight: 600;
}

@media (max-width: 575.98px) {
  .profile-widget .profile-widget-picture {
    left: 50%;
    transform: translate(-50%, 0);
    margin: 40px 0;
    float: none;
  }
  .profile-widget .profile-widget-items .profile-widget-item {
    border-top: 1px solid #f2f2f2;
  }
}
</style>
<?= $this->endSection() ?>