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

        <div  class="w-50">
            <form class="form-signin " method="post" action="musteri_icerik/musteri_ekle_post.php" enctype="multipart/form-data">
                <div class="container col-12  " style="background-color:white;border: 1px solid var(--tblr-border-color);border-radius: 4px;">
                    <div class="row">
                        <div>
                            <h1  class="h3 mb-3 mt-4 font-weight-normal text-danger">MÜŞTERİ EKLEMEK İÇİN </h1>
                            <p style="text-align:center">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
                        </div>
                        <hr>
                        <div  class="form-label-group mb-3 text-start mt-3  col-6">
                            BAŞLIK *
                            <input type="text" class="form-control mt-3" name="baslik" placeholder="baslik" required="" autofocus="">
                        </div>

                        <div c class="form-label-group mb-3 text-start mt-3  col-6">
                            MÜŞTERİ ADI VE SOYADI *
                            <input type="text" class="form-control mt-3" name="musteri_adi" placeholder="musteri_adi" required="" autofocus="">
                        </div>

                        <div  class="form-label-group mb-3 text-start mt-3  col-6">
                            MÜŞTERİ TELEFON NUMARASI *
                            <input type="text" class="form-control mt-3" name="telefon_no" placeholder="telefon_no" required="">
                        </div>

                        <div  class="form-label-group mb-3 text-start mt-3  col-6">
                            <p class=""> MÜŞTERİ ADRESİ * </p>
                            <input type="text" class="form-control mt-3" name="adres" placeholder="adres" required="">
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary mb-3">DÜZENLE</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>