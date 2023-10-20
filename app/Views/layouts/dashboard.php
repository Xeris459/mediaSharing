<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= $title ?></title>

    <!-- lib css -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- lib css -->
    <!-- <link rel="stylesheet" href="<?= site_url('assets/bootstrap/css/bootstrap.min.css') ?>"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/js/trumbowyg/dist/ui/trumbowyg.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/js/trumbowyg/dist/plugins/lainnya/ui/sass/trumbowyg.lainnya.css" rel="stylesheet">
    <link href="<?= site_url('assets/sbadmin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <?= $this->renderSection('css') ?>
</head>
<body id="page-top">
    <div id="wrapper">
        <?= $this->include('components/dashboard/sidebar') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- navbar -->
                <?= $this->include('components/dashboard/navbar') ?>

                <!-- content -->
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>

    <!-- lib js -->
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>/vendor/jquery/jquery.min.js"></script>

<script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>/js/sb-admin-2.min.js"></script>

<script src="<?= base_url() ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/vendor/chart.js/Chart.bundle.min.js"></script>

<!-- sweet alert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- custom JS -->
<script src="<?= base_url('/js/trumbowyg/dist/trumbowyg.min.js') ?>"> </script>

<script src="<?= base_url('/js/custom/custom.js') ?>"> </script>
<script src="<?= base_url('/js/custom/actions.js') ?>"> </script>

<script src="<?= base_url('/js/trumbowyg/dist/plugins/upload/trumbowyg.upload.js') ?>"></script>
<script src="<?= base_url('/js/trumbowyg/dist/plugins/pasteembed/trumbowyg.pasteembed.min.js') ?>"></script>
<script src="<?= base_url('/js/trumbowyg/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js') ?>"></script>
<script src="<?= base_url('/js/trumbowyg/dist/plugins/lainnya/trumbowyg.lainnya.js') ?>"></script>
<?= $this->renderSection('script') ?>
</body>
</html>