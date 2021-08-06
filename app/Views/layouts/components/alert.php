<?php if ($alert = session()->getFlashdata('alert')) : ?>
    <?php if ($alert['warning']) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $alert['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php else : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $alert['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
<?php endif; ?>
