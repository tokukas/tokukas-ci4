<!-- use base template -->
<?= $this->extend('layouts/templates/main'); ?>

<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="preload" href="<?= base_url('styles/css/faq.css'); ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="<?= base_url('styles/css/faq.css'); ?>">
</noscript>

<?= $this->endSection(); ?>

<!-- MAIN SECTION -->
<?= $this->section('main'); ?>

<?php

// get the value of the variable to be displayed
$ourEmail = $variable->getVar('contact_email_cs');
$ourWhatsapp = $variable->getVar('contact_whatsapp');
$ourTelegram = $variable->getVar('contact_telegram');

?>

<section class="container-md p-4">
    <div class="mb-3">
        <h1>Pertanyaan yang Sering Diajukan</h1>
        <hr class="my-1">
        <p><i>Frequently Asked Questions (FAQ)</i></p>
    </div>

    <?php if (empty($faqTopics) && empty($faqList)) : ?>
        <div class="p-4 bg-light border text-center mb-3">
            <span>Belum ada FAQ satupun.</span>
        </div>

    <?php else : ?>
        <div class="mb-3 faq-menus">
            <?php foreach ($faqTopics as $topic) : ?>
                <?php if ($topic === $faqShowTopic) : ?>
                    <a href="<?= base_url('faq'); ?>" class="menu btn btn-outline-secondary active"><?= ucwords($topic); ?></a>
                <?php else : ?>
                    <a href="<?= base_url('faq/' . $topic); ?>" class="menu btn btn-outline-secondary"><?= ucwords($topic); ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="accordion mb-4" id="faqAccordion">
            <?php for ($i = 0; $i < sizeof($faqList); $i++) : ?>
                <?php $faq = $faqList[$i] ?>
                <div class="accordion-item">
                    <div class="accordion-header" id="heading<?= $i; ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i; ?>" aria-expanded="false" aria-controls="collapse<?= $i; ?>">
                            <b><?= ucfirst($faq['question']); ?></b>
                        </button>
                    </div>
                    <div id="collapse<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $i; ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body py-4">
                            <span><?= ucfirst($faq['answer']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

    <div class="py-4">
        <div class="text-center mb-3">
            <p class="h4">Pertanyaan Anda Belum Terjawab?</p>
            <span>Silahkan ajukan pertanyaan anda melalui salah satu kontak di bawah ini.</span>
        </div>
        <div class="contacts list-group list-group-horizontal-md mb-4">
            <a href="mailto:<?= esc($ourEmail, 'attr') ?>" class="list-group-item list-group-item-action" title="Email" data-bs-toggle="tooltip" data-bs-placement="top">
                <i class="fas fa-envelope fa-lg"></i>
                <span><?= esc($ourEmail, 'attr') ?></span>
            </a>
            <a href="https://wa.me/<?= esc($ourWhatsapp, 'attr'); ?>" class="list-group-item list-group-item-action" title="Whatsapp" data-bs-toggle="tooltip" data-bs-placement="top">
                <i class="fab fa-whatsapp fa-lg"></i>
                <span><?= esc($ourWhatsapp, 'attr'); ?></span>
            </a>
            <a href="https://t.me/<?= esc($ourTelegram, 'attr'); ?>" class="list-group-item list-group-item-action" title="Telegram" data-bs-toggle="tooltip" data-bs-placement="top">
                <i class="fab fa-telegram fa-lg"></i>
                <span><?= esc($ourTelegram, 'attr'); ?></span>
            </a>
        </div>
        <div class="information">
            <i class="fas fa-info-circle"></i>
            <span>Mohon untuk menghubungi kami hanya di <a href="<?= base_url('openinghours'); ?>"><b>jam buka</b></a>.</span>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<?= $this->endSection(); ?>
