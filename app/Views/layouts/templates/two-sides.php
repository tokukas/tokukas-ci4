<!-- use base template -->
<?= $this->extend('layouts/templates/base'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('/styles/css/two-sides.css'); ?>">

<?= $this->endSection(); ?>


<!-- CONTENT SECTION -->
<?= $this->section('content'); ?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="box col-lg-6">
                <?= $this->renderSection('left-box'); ?>
            </div>
            <div class="box col-lg-6">
                <?= $this->renderSection('right-box'); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<?= $this->endSection(); ?>
