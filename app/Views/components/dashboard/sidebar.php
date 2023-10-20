<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center bg-white text-dark"  href="<?= site_url() ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="<?= site_url('logo_dp.png') ?>" alt="logo_dp" width="50" height="50" srcset="">
        </div>
        <div class="sidebar-brand-text mx-3">Media Sharing</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Medias
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('image') ?>">
            <i class="fas fa-fw fa-images"></i>
            <span>Gambar Saya</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('category') ?>">
            <i class="fas fa-fw fa-tags"></i>
            <span>Kategori</span></a>
    </li>

    <div class="sidebar-heading">
        Approvement
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('approvement') ?>">
            <i class="fas fa-fw fa-check"></i>
            <span>Approvement</span></a>
    </li>

    <div class="sidebar-heading">
        Website Setting
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('users') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('profile') ?>">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>Profile</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>