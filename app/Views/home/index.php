<!-- use base template -->
<?= $this->extend('layouts/templates/main'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('styles/css/home.css'); ?>">

<?= $this->endSection(); ?>


<!-- MAIN SECTION -->
<?= $this->section('main'); ?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <!-- <img src="..." class="d-block w-100" alt="..."> -->
            <div class="image p-5 bg-warning"></div>
        </div>
        <div class="carousel-item">
            <div class="image p-5 bg-info"></div>
        </div>
        <div class="carousel-item">
            <div class="image p-5 bg-dark"></div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<section class="container-md py-5 px-4 text-center">
    <div class="mb-4">
        <h1>Punya Pertanyaan?</h1>
        <h4>Mungkin <abbr data-bs-toggle="tooltip" data-bs-placement="top" title="Daftar Pertanyaan yang Sering Diajukan">FAQ</abbr> ini dapat menjawab pertanyaan anda.</h4>
    </div>
    <a href="<?= base_url('faq'); ?>" class="btn btn-primary btn-lg">
        <i class="material-icons">quiz</i>
        <span>Lihat FAQ</span>
    </a>
</section>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<?= $this->endSection(); ?>
