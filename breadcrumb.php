<?php $breadcrumbs = isset($breadcrumbs) ? $breadcrumbs : []; ?>
<ul class="breadcrumb breadcrumb-bullets mt-4" style="
-webkit-column-gap: 10px;">

    <li><a href="../anasayfa.php">Anasayfa</a></li>
    <?php foreach ($breadcrumbs as $b) : ?> .
        <li><a href="<?= $b["link"] ?>"><?= $b["baslik"] ?></a></li>
    <?php endforeach; ?>
</ul>
<hr>