<?php

use function PHPSTORM_META\sql_injection_subst;

include "../header.php";
include "../db.php";
include "../islem2.php";
?>
<div class="container page" style="text-align:-webkit-center">
    <?php
    $breadcrumbs = 
    [
        [
            "link" => "musteri_eleman.php", 
            "baslik" => "Musteri ELeman"
        ],
             ["link" => "musteri_eleman_ekle_form.php?id=",
              "baslik" => "Musteri Eleman Ekle"
              ]
            ];



    include "../breadcrumb.php"; ?>

    <form class="form-signin w-50 container" method="post" action="musteri_eleman_ekle_post.php" enctype="multipart/form-data">
        <div class="container col-12 " style="background-color:white;border: 1px solid var(--tblr-border-color);border-radius: 4px;">
            <div class="row">
                <div>
                    <h1 class=" mb-3 mt-3 font-weight-normal text-danger">MÜŞTERİ ELEMANI EKLEMEK İÇİN </h1>
                    <p class="text-danger text-center">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
                </div>
                <hr>
                <div class="form-label-group mb-3 text-start mt-3 col-6">
                    ELEMAN ADI VE SOYADI *
                    <input type="text" class="form-control mt-3" name="eleman_adi" placeholder="eleman_adi" required="" autofocus="">
                </div>

                <div class="form-label-group mb-3 text-start mt-3 col-6">
                    ELEMAN TELEFON NUMARASI *
                    <input type="text" class="form-control mt-3" name="telefon_no" placeholder="telefon_no" required="">
                </div>
                <div class="form-label-group mb-3 text-start mt-3 col-6">
                    E POSTA *
                    <input type="text" class="form-control mt-3" name="e_posta" placeholder="e_posta" required="">
                </div>
                <div class="form-label-group mb-3 text-start mt-3 col-6">
                    SORUMLU ADI SOYADI *
                    <select class="form-select form-control mt-3" name="musteri_id" aria-label="Default select example">
                        <option value="0" selected>SORUMLU SEÇİNİZ</option>
                        <?php foreach ($db->query("SELECT * from musteriler") as $musteriler) { ?>

                            <option value="<?php echo $musteriler["id"] ?>">
                                <?= $musteriler["musteri_adi"] . " " ?></option>

                        <?php } ?>
                    </select>
                </div>
                <div class="form-label-group  text-start mt-3 ">
                    ÜNVAN *
                    <input type="text" class="form-control mt-3" name="unvan" placeholder="e_posta" required="">
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary mb-3">DÜZENLE</button>
                </div>

            </div>
    </form>
</div>