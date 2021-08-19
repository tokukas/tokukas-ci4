<!-- use base template -->
<?= $this->extend('layouts/templates/main'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('/styles/css/account.css'); ?>">

<?= $this->endSection(); ?>


<!-- MAIN SECTION -->
<?= $this->section('main'); ?>

<section class="container-md p-4">
    <div class="mb-4">
        <h2>Informasi Akun</h2>
        <hr class="mt-1">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Nama</th>
                        <td class="d-flex gap-3 align-items-center">
                            <span><?= $loginSession['name']; ?></span>
                            <a href="<?= base_url('/account/change/name'); ?>">Ubah</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td class="d-flex gap-3 align-items-center">
                            <span><?= $loginSession['email']; ?></span>
                            <a href="<?= base_url('/account/change/email'); ?>">Ubah</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Kata Sandi</th>
                        <td><a href="<?= base_url('/account/change/password'); ?>" class="btn btn-outline-danger btn-sm">Ubah Kata Sandi</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-4">
        <h2>Alamat Saya</h2>
        <hr class="mt-1">
        <div class="address-container">
            <div class="card" style="width: 20rem;">
                <div class="card-header">
                    <h5 class="card-title my-0">Rumah 1</h5>
                    <span class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Alamat ini telah diatur menjadi alamat utama.">Utama</span>
                </div>
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="#" class="btn btn-sm btn-outline-secondary flex-fill">
                            <i class="material-icons">edit</i>
                            <span>Ubah</span>
                        </a>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="material-icons">delete</i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 20rem;">
                <div class="card-header">
                    <h5 class="card-title my-0">Rumah 2</h5>
                    <a href="#" class="card-link">Jadikan Utama</a>
                </div>
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="#" class="btn btn-sm btn-outline-secondary flex-fill">
                            <i class="material-icons">edit</i>
                            <span>Ubah</span>
                        </a>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="material-icons">delete</i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card border-primary text-primary" style="width: 20rem;">
                <a href="<?= base_url('/address/new'); ?>" class="card-body p-4 d-flex flex-column gap-3 justify-content-center align-items-center" style="text-decoration: none;">
                    <i class="material-icons" style="font-size: 2rem;">add_circle_outline</i>
                    <span class="card-text"><strong>Tambah Alamat Baru</strong></span>
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<?= $this->endSection(); ?>
