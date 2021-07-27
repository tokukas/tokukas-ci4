<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </noscript>

    <!-- Font -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap">
    </noscript>

    <!-- Icons -->
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined&display=swap">
    </noscript>


    <!-- Global app styles -->
    <link rel="stylesheet" href="<?= base_url('/styles/css/base.css'); ?>">

    <!-- Custom styles -->
    <?= $this->renderSection('custom-styles'); ?>

    <!-- Web properties -->
    <link rel="shortcut icon" href="<?= base_url('/assets/favicon.ico'); ?>" type="image/x-icon">
    <title><?= $title; ?></title>
</head>

<body>

    <?= $this->renderSection('content'); ?>

    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="<?= base_url('/vendor/jquery/jquery-3.6.0.min.js'); ?>"></script>

    <!-- App script -->
    <script src="<?= base_url('/scripts/js/app.js'); ?>"></script>

    <!-- Custom scripts -->
    <?= $this->renderSection('custom-scripts'); ?>

</body>

</html>
