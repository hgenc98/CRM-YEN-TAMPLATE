<?php $breadcrumbs = isset($breadcrumbs) ? $breadcrumbs : []; ?>
<div class="d-flex align-items-center mt-3   justify-content-between">
    <ul class="breadcrumb breadcrumb-bullets " style="
-webkit-column-gap: 10px;">

        <li><a href="../anasayfa.php">Anasayfa</a></li>
        <?php foreach ($breadcrumbs as $b) : ?> .
            <li><a href="<?= $b["link"] ?>"><?= $b["baslik"] ?></a></li>
        <?php endforeach; ?>
    </ul>
    <?php $butonlar = isset($butonlar) ? $butonlar : []; ?>

    <?php foreach ($butonlar as $b) : ?>
        <?php
        $rol = $_SESSION['rol'];
        if ($rol == 1) { ?>
            <a href="<?= $b["link"] ?>" class="btn btn-<?= $b["renk"] ?>"><i class="fa me-2 fa-<?= $b["ikon"] ?>"></i> <?= $b["ad"] ?></a>
        <?php }  ?>

    <?php endforeach; ?>
</div>
