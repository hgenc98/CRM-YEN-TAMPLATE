<?php
include "../header.php";
include "../db.php";
include "../islem2.php";
?>
<div class="container page">
    <div style="text-align: -webkit-center;">
        <?php
        $breadcrumbs = [["link" => "musteriler.php", "baslik" => "Musteriler"], ["link" => "musteri_ekle_form.php?id=", "baslik" => "Musteri Ekle"]];
        include "../breadcrumb.php"; ?>

        <div style="border:solid ;background-color:white " class="w-50">
            <form class="form-signin " method="post" action="musteri_icerik/musteri_ekle_post.php" enctype="multipart/form-data">
                <div class="container">
                    <div>
                        <h1 style="color:brown" class="h3 mb-3 mt-4 font-weight-normal">MÜŞTERİ EKLEMEK İÇİN </h1>
                        <p style="color:brown;text-align:center">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
                    </div>
                    <hr>
                    <div class="form-label-group mt-5 ml-5 mr-5" style="color:brown">
                        BAŞLIK *
                        <input type="text" class="form-control" name="baslik" placeholder="baslik" required="" autofocus="">
                    </div>

                    <div class="form-label-group ml-5 mr-5" style="color:brown">
                        MÜŞTERİ ADI VE SOYADI *
                        <input type="text" class="form-control" name="musteri_adi" placeholder="musteri_adi" required="" autofocus="">
                    </div>

                    <div class="form-label-group ml-5 mr-5" style="color:brown">
                        MÜŞTERİ TELEFON NUMARASI *
                        <input type="text" class="form-control" name="telefon_no" placeholder="telefon_no" required="">
                    </div>

                    <div class="form-label-group ml-5 mr-5" style="color:brown">
                        <p class=""> MÜŞTERİ ADRESİ * </p>
                        <input type="text" class="form-control" name="adres" placeholder="adres" required="">
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary mb-3">DÜZENLE</button>
                    </div>
                </div>
        </div>
    </div>
    </form>