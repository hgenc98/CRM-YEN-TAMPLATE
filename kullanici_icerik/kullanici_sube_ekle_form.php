<?php
include "../header.php";
include "../db.php";
include "../islem2.php";
?>

<div class="page">
    <div class="container" style="text-align: -webkit-center;">
        <?php
        $breadcrumbs = [["link" => "kullanici_subeler.php", "baslik" => "Kullanici Subeleri"], ["link" => "kullanici_ekle_form.php", "baslik" => "Sube Ekle"]];
        include "../breadcrumb.php"; ?>
        <form class="form-signin w-100" method="post" action="kullanici_sube_ekle_post.php" enctype="multipart/form-data">
            <div class="container w-50 col-12 " style="background-color:white;border: 1px solid var(--tblr-border-color);
                              border-radius: 4px;">
                <div class="row">
                    <div>
                        <h1 class="text-danger h3 mb-3 mt-3 font-weight-normal">ŞUBE EKLEMEK İÇİN </h1>
                        <p>Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
                    </div>
                    <hr>
                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        E-POSTA *
                        <input type="email" class="form-control mt-3" name="e_posta" placeholder="e posta" required="">
                    </div>
                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        YETKİLİ ADI VE SOYADI *
                        <input type="text" class="form-control mt-3" name="yetkili_adi" placeholder="yetkili adi" required="">
                    </div>
                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        YETKİLİ TELEFONU *
                        <input type="number" class="form-control mt-3" name="yetkili_telefon" placeholder="yetkili telefon" required="">
                    </div>

                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        ŞUBE ADI *
                        <input type="text" class=" form-control mt-3" name="sube_adi" placeholder="sube adi" required="" autofocus="">
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary mb-3">EKLE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
