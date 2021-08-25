<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc($pageDesc ?: $variable->getVar('store_description')); ?>">

    <!-- Bootstrap CSS -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </noscript>

    <!-- Fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap">
    </noscript>

    <!-- Icons -->
    <!-- Material Icons -->
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Material+Icons&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons&display=swap">
    </noscript>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/a4efd995d2.js" crossorigin="anonymous" defer></script>


    <!-- Global app styles -->
    <link rel="preload" href="<?= base_url('styles/css/alert.css'); ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="<?= base_url('styles/css/alert.css'); ?>">
    </noscript>

    <link rel="preload" href="<?= base_url('styles/css/base.css'); ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="<?= base_url('styles/css/base.css'); ?>">
    </noscript>

    <!-- Custom styles -->
    <?= $this->renderSection('custom-styles'); ?>

    <!-- Web properties -->
    <link rel="shortcut icon" href="<?= base_url('assets/favicon.ico'); ?>" type="image/x-icon">
    <title><?= $title; ?></title>
</head>

<body>
    <!-- import alert -->
    <?= $this->include('layouts/components/alert'); ?>

    <?= $this->renderSection('content'); ?>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" defer></script>

    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>

    <!-- App script -->
    <script src="<?= base_url('scripts/js/app.js'); ?>" defer></script>
    <script src="<?= base_url('scripts/js/helper.js'); ?>" defer></script>
    <script src="<?= base_url('scripts/js/tooltips.js'); ?>" defer></script>

    <!-- Custom scripts -->
    <?= $this->renderSection('custom-scripts'); ?>

    <!-- Print console -->
    <?php if ($console = session()->getFlashdata('console')) : ?>
        <script>
            <?= $console['script']; ?>
        </script>
    <?php endif; ?>
</body>

</html>
