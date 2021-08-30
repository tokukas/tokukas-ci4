<!-- use base template -->
<?= $this->extend('layouts/templates/base'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="preload" href="<?= base_url('styles/css/footer.css'); ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="<?= base_url('styles/css/footer.css'); ?>">
</noscript>

<link rel="preload" href="<?= base_url('styles/css/about.css'); ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="<?= base_url('styles/css/about.css'); ?>">
</noscript>

<?= $this->endSection(); ?>


<!-- CONTENT SECTION -->
<?= $this->section('content'); ?>

<?php

$brandName = $variable->getVar('brand_name');
$brandName2 = $variable->getVar('brand_name2');
$brandSlogan = $variable->getVar('brand_jargon');
$ourTokopedia = $variable->getVar('link_store_tokopedia');
$ourShopee = $variable->getVar('link_store_shopee');

?>

<div class="jumbotron">
    <img class="brand-logo" src="<?= base_url('assets/brand-white.svg'); ?>" alt="logo" height="100" width="180" role="img">
    <h1 class="brand-name"><?= esc($brandName2); ?></h1>
    <span class="slogan"><?= esc($brandSlogan); ?></span>
</div>
<nav class="menus">
    <ul>
        <li class="sticky"><a href="<?= base_url(); ?>">Beranda</a></li>
        <li><a href="<?= base_url('login'); ?>">Masuk</a></li>
        <li><a href="<?= base_url('register'); ?>">Daftar</a></li>
    </ul>
</nav>
<section class="">
    <article class="content">
        <h1>Tentang <span translate="no"><?= esc($brandName); ?></span></h1>
        <hr>
        <p><b><span class="tokukas" title="Toko Buku Bekas" translate="no"><?= esc($brandName); ?></span></b> adalah sebuah toko yang menawarkan buku-buku bekas dengan harga yang terjangkau.</p>
        <p>Buku-buku bekas yang dijual oleh <b><span class="tokukas" title="Toko Buku Bekas" translate="no"><?= esc($brandName); ?></span></b> didapat dari hasil kerjasama dengan toko buku yang menjual buku bekas secara langsung di toko (luring/<i>offline</i>), dan juga didapat dengan membeli dari masyarakat yang memiliki buku-buku bekas yang ditawarkan kepada toko secara daring melalui formulir yang disediakan oleh toko.</p>
        <p>Selain dapat diakses dari website, <b><span class="tokukas" title="Toko Buku Bekas" translate="no"><?= esc($brandName); ?></span></b> juga hadir di beberapa platform <i>e-commerce</i> populer di Indonesia, seperti <a href="<?= esc($ourShopee, 'attr'); ?>" rel="noreferrer" target="_blank" translate="no">Shopee</a> dan <a href="<?= esc($ourTokopedia, 'attr'); ?>" target="_blank" rel="noreferrer" translate="no">Tokopedia</a>.</p>
    </article>
</section>

<!-- import footer -->
<?= $this->include('layouts/components/footer'); ?>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<?= $this->endSection(); ?>
