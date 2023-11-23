<div class="wrapper-banner">
    <div class="absolute logo-wrapper">
        <div class="logo">
            <img src="<?= site_url('logo_jkt.png') ?>" alt="">
        </div>
        <div class="logo">
            <img src="<?= site_url('logo_dp.png') ?>" alt="">
        </div>
    </div>
      <img class="" src="<?= site_url('IMG_1475.JPG') ?>" alt="" srcset="">
</div>

<?= $this->section('css') ;?>
<style>
.wrapper-banner {
    height: 200px;
    width: 100%;
    padding: 0px;
    margin: 0px;
    position: relative;
}

.wrapper-banner img {
    height: 100%;
    width: 100%;
    object-fit: cover;
}

.absolute {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}

.logo-wrapper {
    display: flex;
    justify-content: space-between;
    justify-items: center;
    width: 100%;
    height: 100%;
}

.logo {
    margin: auto 0;
    padding: 0 30px;
}

.logo-wrapper .logo img {
    height: 100px;
}
</style>
<?= $this->endSection() ;?>
