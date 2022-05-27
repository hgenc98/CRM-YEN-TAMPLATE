<?php

use function PHPSTORM_META\sql_injection_subst;

include "../header.php";
include "../db.php";
include "../islem2.php";
?>
<div class="container page"style="text-align:-webkit-center">
    <?php
    $breadcrumbs = [["link" => "musteriler.php", "baslik" => "Musteriler"], ["link" => "musteri_eleman_ekle_form.php?id=", "baslik" => "Musteri Eleman Ekle"]];
    include "../breadcrumb.php"; ?>

    <form class="form-signin w-50 container" method="post" action="musteri_eleman_ekle_post.php" enctype="multipart/form-data"style="text-align:-webkit-center ;border:solid;border-radius:20px;text-align: -webkit-center;background-color:white">
        <div>
            <h1 style="color:brown" class=" mb-3 mt-3 font-weight-normal">MÜŞTERİ ELEMANI EKLEMEK İÇİN </h1>
            <p style="color:brown;text-align:center">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
        </div>
        <hr>
        <div class="container">
            <div class="form-label-group mt-3 mb-4 " >
                ELEMAN ADI VE SOYADI *
                <input type="text" class="form-control" name="eleman_adi" placeholder="eleman_adi" required="" autofocus="">
            </div>

            <div class="form-label-group mb-4" >
                ELEMAN TELEFON NUMARASI *
                <input type="text" class="form-control" name="telefon_no" placeholder="telefon_no" required="">
            </div>
            <div class="form-label-group mb-4" >
                E POSTA *
                <input type="text" class="form-control" name="e_posta" placeholder="e_posta" required="">
            </div>
            <div class="mb-4">
                SORUMLU ADI SOYADI *
                <select class="form-select form-control " name="musteri_id" aria-label="Default select example">
                    <option value="0" selected>SORUMLU SEÇİNİZ</option>
                    <?php foreach ($db->query("SELECT * from musteriler") as $musteriler) { ?>

                        <option value="<?php echo $musteriler["id"] ?>">
                            <?= $musteriler["musteri_adi"] . " " ?></option>

                    <?php } ?>
                </select>
            </div>
            <div class="form-label-group mt-4 " >
                ÜNVAN *
                <input type="text" class="form-control" name="unvan" placeholder="e_posta" required="">
            </div>
            <div style="text-align: center;">
                <button class="mt-5 mb-5" type="submit" style="border:4px outset, ; border-radius:10px;background-image: radial-gradient(100% 100% at 100% 0px,
            rgb(90, 218, 255) 0px, rgb(84, 104, 255) 100%) !important; width: 50%;">
                    EKLE
                </button>
            </div>
        </div>
    </form>
</div>