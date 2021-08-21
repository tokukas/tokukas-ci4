<!-- use base template -->
<?= $this->extend('layouts/templates/main'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('styles/css/offer.css'); ?>">

<?= $this->endSection(); ?>


<!-- MAIN SECTION -->
<?= $this->section('main'); ?>

<section class="container p-4">
    <div class="row mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Penawaran Saya</h1>
            <a class="btn btn-primary" href="<?= base_url('offer/new'); ?>" title="Buat Penawaran" data-bs-toggle="tooltip" data-bs-placement="left">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <hr>
    </div>
    <div class="row mb-3">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?= base_url('offer'); ?>">
                    <i class="fas fa-list"></i>
                    <span class="ms-1">Semua Penawaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('offer/negotiate'); ?>">
                    <i class="fas fa-handshake"></i>
                    <span class="ms-1">Negosiasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('offer/approved'); ?>">
                    <i class="fas fa-check"></i>
                    <span class="ms-1">Disetujui</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('offer/rejected'); ?>">
                    <i class="fas fa-times"></i>
                    <span class="ms-1">Ditolak</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="row py-3">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card p-0">
                <div class="card-header">
                    <strong class="card-title m-0"><?= $offerId = strtoupper(code_generator(16, true)); ?></strong>
                    <span class="badge bg-secondary">Sedang Ditinjau</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="field">
                            <i class="fas fa-book-open"></i>
                            <span>Jumlah Buku</span>
                        </div>
                        <span class="value">1 Buku</span>
                    </li>
                    <li class="list-group-item">
                        <div class="field">
                            <i class="fas fa-handshake"></i>
                            <span>Metode Transaksi</span>
                        </div>
                        <span class="value">Online</span>
                    </li>
                    <li class="list-group-item">
                        <div class="field">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Total Harga</span>
                        </div>
                        <span class="value"><?= idn_format_number(rand(0, 1000000), 0, 'Rp'); ?></span>
                    </li>
                    <li class="list-group-item">
                        <div class="field">
                            <i class="fas fa-credit-card"></i>
                            <span>Metode Pembayaran</span>
                        </div>
                        <span class="value">OVO</span>
                    </li>
                    <li class="list-group-item">
                        <div class="field">
                            <i class="fas fa-truck"></i>
                            <span>Ekspedisi</span>
                        </div>
                        <span class="value">SICEPAT</span>
                    </li>
                    <li class="list-group-item">
                        <div class="field">
                            <i class="fas fa-clock"></i>
                            <span>Waktu Pengajuan</span>
                        </div>
                        <span class="value"><?= date('Y-m-d, H:i', time()); ?></span>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('offer/' . $offerId); ?>" class="btn btn-primary flex-fill">
                            <i class="fas fa-eye"></i>
                            <span>Lihat Rincian</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<?= $this->endSection(); ?>
