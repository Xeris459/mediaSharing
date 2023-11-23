<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= $title ?></title>

    <!-- lib css -->
    <link rel="stylesheet" href="<?= site_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- style -->
    <style>
        body {
            padding: 0px;
            margin: 0px;
        }
    </style>
    <?= $this->renderSection('css') ?>
</head>
<body>
    <main>
        <?= $this->renderSection('content') ?>
    </main>
</body>
<?= $this->include('components/TheScripts') ?>
</html>