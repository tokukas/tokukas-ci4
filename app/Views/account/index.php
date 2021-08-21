<!-- use base template -->
<?= $this->extend('layouts/templates/main'); ?>


<!-- CUSTOM STYLES SECTION -->
<?= $this->section('custom-styles'); ?>

<link rel="stylesheet" href="<?= base_url('styles/css/account.css'); ?>">

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
                            <a href="<?= base_url('account/change/name'); ?>">Ubah</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td class="d-flex gap-3 align-items-center">
                            <span><?= $loginSession['email']; ?></span>
                            <a href="<?= base_url('account/change/email'); ?>">Ubah</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Kata Sandi</th>
                        <td><a href="<?= base_url('account/change/password'); ?>" class="btn btn-outline-danger btn-sm">Ubah Kata Sandi</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-4">
        <h2>Alamat Saya</h2>
        <hr class="mt-1">
        <div class="address-container">
            <?php foreach ($myAddresses as $address) : ?>
                <div class="card" style="width: 20rem;">
                    <div class="card-header">
                        <h5 class="card-title my-0"><?= $address['label']; ?></h5>

                        <?php if ($address['is_default']) : ?>
                            <span class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Alamat ini telah diatur menjadi alamat utama.">Utama</span>
                        <?php else : ?>
                            <form action="<?= base_url('address/default'); ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="address_id" value="<?= $address['id']; ?>">
                                <button type="submit" class="btn btn-link p-0">Jadikan Utama</button>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $address['stringified']; ?></p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('address/edit/' . $address['id']); ?>" class="btn btn-sm btn-outline-secondary flex-fill">
                                <i class="material-icons">edit</i>
                                <span>Ubah</span>
                            </a>
                            <button type="button" class="delete-toggle btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirm" data-link="<?= base_url('address/' . $address['id']); ?>">
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="card border-primary text-primary" style="width: 20rem;">
                <a href="<?= base_url('address/new'); ?>" class="card-body p-4 d-flex flex-column gap-3 justify-content-center align-items-center" style="text-decoration: none;">
                    <i class="material-icons" style="font-size: 2rem;">add_circle_outline</i>
                    <span class="card-text"><strong>Tambah Alamat Baru</strong></span>
                </a>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="deleteConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus alamat ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                    <i class="material-icons">close</i>
                    <span>Batalkan</span>
                </button>
                <form action="" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="material-icons">delete</i>
                        <span>Hapus Alamat</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<!-- CUSTOM SCRIPTS SECTION -->
<?= $this->section('custom-scripts'); ?>

<script src="<?= base_url('scripts/js/account.js'); ?>"></script>

<?= $this->endSection(); ?>
