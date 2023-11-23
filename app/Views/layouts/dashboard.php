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

    <style>
    .gj-picker-bootstrap table tr td div {
        color: #292929;
    }

    .gj-picker-bootstrap table tr td.other-month div {
        color: #878787;
    }

    .gj-picker-bootstrap table tr td.disabled div {
        color: #b5b5b5;
    }

    .lds-dual-ring {
        position: relative;
        top: 50%;
        left: 45%;
        display: block;
        width: 80px;
        height: 80px;
    }

    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 8px;
        border-radius: 50%;
        border: 6px solid #365DCD;
        border-color: #365DCD transparent #365DCD transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #message {
        position: absolute;
        top: 0;
        right: 0;
        width: 30%;
        z-index: 999;
        margin-top: 10px;
    }

    /* #mess {
        position: relative;
        top: 0;
        right: 0;
        /* width: 30%;
        z-index: 999;
        margin-top:10px; */
    }

    */ .alert {
        position: fixed;
    }

    #inner-message {
        margin: 0 auto;
    }

    .modal {
        padding: 0 !important; // override inline padding-right added from js
    }

    .modal .modal-dialog {
        width: 60%;
        max-width: none;
    }

    .modal .modal-content {
        border: 0;
        border-radius: 0;
    }

    .modal .modal-body {
        overflow-y: auto;
    }

    label {
        width: 100%;
        font-size: 1rem;
    }

    .lead {
        font-size: 1rem;
        font-weight: 400 !important;
    }

    .card-input-element+.card {
        height: calc(150px + 2*1rem);
        color: var(--primary);
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 2px solid transparent;
        border-radius: 4px;
    }

    .card-input-element+.card:hover {
        cursor: pointer;
    }

    .card-input-element:checked+.card {
        border: 2px solid var(--primary);
        -webkit-transition: border .3s;
        -o-transition: border .3s;
        transition: border .3s;
    }

    .card-input-element:checked+.card::after {
        content: '\e5ca';
        color: #AFB8EA;
        font-family: 'Material Icons';
        font-size: 24px;
        -webkit-animation-name: fadeInCheckbox;
        animation-name: fadeInCheckbox;
        -webkit-animation-duration: .5s;
        animation-duration: .5s;
        -webkit-animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    @-webkit-keyframes fadeInCheckbox {
        from {
            opacity: 0;
            -webkit-transform: rotateZ(-20deg);
        }

        to {
            opacity: 1;
            -webkit-transform: rotateZ(0deg);
        }
    }

    @keyframes fadeInCheckbox {
        from {
            opacity: 0;
            transform: rotateZ(-20deg);
        }

        to {
            opacity: 1;
            transform: rotateZ(0deg);
        }
    }
    </style>
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

                <!-- alert -->
                
                <!-- content -->
                <div class="container-fluid">
                    <?= $this->include('components/dashboard/alert') ?>

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