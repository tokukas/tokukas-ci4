<!-- use base template -->
<?= $this->extend('layouts/templates/main'); ?>

<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('/styles/css/faq.css'); ?>">

<?= $this->endSection(); ?>

<!-- MAIN SECTION -->
<?= $this->section('main'); ?>

<section class="container-md p-4">
    <div class="mb-3">
        <h1>Pertanyaan yang Sering Diajukan</h1>
        <hr class="my-1">
        <span><i>Frequently Asked Questions (FAQ)</i></span>
    </div>
    <div class="mb-3 faq-menus">
        <?php foreach ($faqTopics as $topic) : ?>
            <?php if ($topic === $faqShowTopic) : ?>
                <a href="<?= base_url('/faq'); ?>" class="menu btn btn-outline-secondary active"><?= ucwords($topic); ?></a>
            <?php else : ?>
                <a href="<?= base_url('/faq/' . $topic); ?>" class="menu btn btn-outline-secondary"><?= ucwords($topic); ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="accordion mb-4" id="faqAccordion">
        <?php for ($i = 0; $i < sizeof($faqList); $i++) : ?>
            <?php $faq = $faqList[$i] ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?= $i; ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i; ?>" aria-expanded="false" aria-controls="collapse<?= $i; ?>">
                        <b><?= ucfirst($faq['question']); ?></b>
                    </button>
                </h2>
                <div id="collapse<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $i; ?>" data-bs-parent="#faqAccordion">
                    <div class="accordion-body py-4">
                        <span><?= ucfirst($faq['answer']); ?></span>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <div class="py-4">
        <div class="text-center mb-3">
            <h4>Pertanyaan Anda Belum Terjawab?</h4>
            <span>Silahkan ajukan pertanyaan anda melalui :</span>
        </div>
        <div class="contacts list-group list-group-horizontal-md mb-4">
            <a href="mailto:tokukas@outlook.com" class="list-group-item list-group-item-action" title="Email" data-bs-toggle="tooltip" data-bs-placement="top">
                <i class="fas fa-envelope fa-lg"></i>
                <span>tokukas@outlook.com</span>
            </a>
            <a href="https://wa.me/+6285315360808" class="list-group-item list-group-item-action" title="Whatsapp" data-bs-toggle="tooltip" data-bs-placement="top">
                <i class="fab fa-whatsapp fa-lg"></i>
                <span>+6285315360808</span>
            </a>
            <a href="https://t.me/tokukas" class="list-group-item list-group-item-action" title="Telegram" data-bs-toggle="tooltip" data-bs-placement="top">
                <i class="fab fa-telegram fa-lg"></i>
                <span>tokukas</span>
            </a>
        </div>
        <div class="information">
            <i class="fas fa-info-circle"></i>
            <span>Mohon untuk menghubungi kami hanya di <a href="<?= base_url('/openinghours'); ?>"><b>jam buka</b></a>.</span>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<?= $this->endSection(); ?>
