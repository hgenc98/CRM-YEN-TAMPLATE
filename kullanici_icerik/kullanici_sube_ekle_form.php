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
            <div class="container w-50 bg-light" style="border: solid;border-radius:20px;">
            <div>
                <h1 style="color:brown" class="h3 mb-3 mt-3 font-weight-normal">ŞUBE EKLEMEK İÇİN </h1>
                <p style="color:brown;text-align:center">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
            </div>
                <div class="form-label-group mt-3 mb-3" style="color:brown">
                    ŞUBE ADI *
                    <input type="text" class="form-control" name="sube_adi" placeholder="sube_adi" required="" autofocus="">
                </div>
                <div class="form-label-group mb-3" style="color:brown">
                    YETKİLİ ADI VE SOYADI *
                    <input type="text" class="form-control" name="yetkili_adi" placeholder="yetkili_adi" required="">
                </div>
                <div class="form-label-group mb-3" style="color:brown">
                    YETKİLİ TELEFONU *
                    <input type="number" class="form-control" name="yetkili_telefon" placeholder="yetkili_telefon" required="">
                </div>
                <div class="form-label-group mb-3" style="color:brown">
                    E-POSTA *
                    <input type="email" class="form-control" name="e_posta" placeholder="e_posta" required="">
                </div>
                <div style="text-align: center;">
                    <button class="mb-3 mt-3" type="submit" style="border:4px outset, ; border-radius:10px;background-image: radial-gradient(100% 100% at 100% 0px,
            rgb(90, 218, 255) 0px, rgb(84, 104, 255) 100%) !important; width: 50%;">
                        EKLE
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="../dist/js/tabler.min.js"></script>
<script src="../dist/js/demo.min.js"></script>