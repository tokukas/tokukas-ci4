<!-- use base template -->
<?= $this->extend('layouts/templates/base'); ?>

<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('/styles/css/navbar.css'); ?>">

<?= $this->endSection(); ?>


<!-- CONTENT SECTION -->
<?= $this->section('content'); ?>

<header>
    <!-- import top navbar -->
    <?= $this->include('layouts/components/navbar'); ?>
</header>

<main id="pageTop">

    <?= $this->renderSection('main'); ?>

</main>

<footer>

</footer>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<?= $this->endSection(); ?>
