<div class="wrapper-banner">
    <div class="absolute logo-wrapper">
        <div class="logo">
            <img src="<?= site_url('logo_jkt.png') ?>" alt="">
        </div>
        <div class="logo">
            <img src="<?= site_url('logo_dp.png') ?>" alt="">
        </div>
    </div>
      <img class="" src="https://scontent-sin6-4.xx.fbcdn.net/v/t39.30808-6/370907745_2280263812165901_1708711434859393315_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=52f669&_nc_eui2=AeGD-arvI4KNy9DrzUZhwwg-e9FLPHBnSQ570Us8cGdJDg48Qx6HZcV4AelHJegAhJDm_aDNgVVci-pNS5mgUbCt&_nc_ohc=9FMnkPzJR20AX-V-k9T&_nc_ht=scontent-sin6-4.xx&oh=00_AfBzzEJYzoaoDzqShRXozip4N6XTNDRwloUiRDtO9YvZgw&oe=651DAD48" alt="" srcset="">
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
