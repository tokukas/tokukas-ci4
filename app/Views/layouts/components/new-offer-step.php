<ol class="list-group list-group-numbered mb-3">
    <?php for ($i = 0; $i < sizeof($step['list']); $i++) : ?>
        <?php $stepNow = $step['list'][$i]; ?>

        <?php if ($i < $step['current']) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <a href="<?= base_url('offer/new/' . $i + 1); ?>" class=""><?= $stepNow ?></a>
                </div>
                <span class="badge bg-primary rounded-pill">
                    <i class="fas fa-check"></i>
                </span>
            </li>
        <?php elseif ($i === $step['current']) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-start active">
                <div class="ms-2 me-auto">
                    <span class=""><?= $stepNow; ?></span>
                </div>
            </li>
        <?php else : ?>
            <li class="list-group-item d-flex justify-content-between align-items-start disabled">
                <div class="ms-2 me-auto">
                    <span class=""><?= $stepNow; ?></span>
                </div>
            </li>
        <?php endif; ?>
    <?php endfor; ?>
</ol>
