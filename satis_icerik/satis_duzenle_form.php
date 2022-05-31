<?php
include "../db.php";
include "../header.php";
include "../islem2.php";
try {
    //echo "Veri çekme işlemi";

} catch (PDOException $e) {
    die($e->getMessage());
}
$duzenle = null;
$baglanti = null;
if ($_GET) {
    $SELECT = $db->prepare(" SELECT * FROM satislar WHERE id=?");
    $musteriler = $db->query(" SELECT * FROM `musteriler`")->fetchAll();
    $kullanicilar = $db->query(" SELECT * FROM `kullanicilar`")->fetchAll();
    $a = $db->query(" SELECT * FROM `satis_kalemleri`where id")->fetchAll();

    $SELECT->execute([$_GET['id']]);
    $duzenle = $SELECT->fetch();
}
?>
<div class="container page">
    <?php
    $breadcrumbs = [["link" => "satislar.php", "baslik" => "Satislar"], ["link" => "satis_duzenle_form.php?id=" . $_GET["id"], "baslik" => "Satis Duzenle"]];
    include "../breadcrumb.php"; ?>
    <div style="text-align:-webkit-center;">
        <form class="form-signin w-50" method="POST" action="satis_duzenle_post.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
            <div class="container col-12  " style="background-color:white;border: 1px solid var(--tblr-border-color);border-radius: 4px;">
                <div class="row">
                    <h3 class="mt-3 mb-4 text-danger" >SATIŞ DÜZENLE</h3>
                    <hr>
                    <div  class="form-label-group mb-3 text-start mt-3  col-6" >
                        MÜŞTERİ ADI SOYADI *
                        <select name="musteri_id"  class="mt-3 col-12 text-center" style="height: 35px;">
                            <?php foreach ($musteriler as $musteri) {
                            ?>
                                <option value="<?php echo $musteri["id"] ?>" <?php echo $duzenle["musteri_id"] == $musteri["id"] ? "selected" : NULL ?>> <?php echo $musteri["musteri_adi"] ?> </option>

                            <?php } ?>
                        </select>
                    </div>
                    <div  class="form-label-group mb-3 text-start mt-3  col-6" >
                       KULLANICI ADI SOYADI *
                        <select name="kullanici_id" id="" class="mt-3 col-12 text-center" style="height: 35px;">
                            <?php foreach ($kullanicilar as $kullanici) { ?>
                                <option value="<?php echo $kullanici["id"] ?> " <?php echo $duzenle["kullanici_id"] == $kullanici["id"] ? "selected" : NULL ?>> <?php echo $kullanici["kullanici_adi"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div  class="form-label-group mb-3 text-start mt-3  col-6" >
                         SATIŞ TARİHİ *
                        <input type="datetime-local" value="<?= $duzenle["satis_tarihi"] ?>" class="form-control mt-3 text-center" name="satis_tarihi" placeholder="satis_tarihi" required autofocus>
                    </div>
                    <div  class="form-label-group mb-3 text-start mt-3  col-6">
                      ÜRÜN ADI *

                        <select name="urun_adi" id="" class="mt-3 col-12 text-center" style="height: 35px;">
                            <?php foreach ($a as $sa) { ?>
                                <option value="<?php echo $sa["id"] ?> " <?php echo $sa["urun_adi"] == $sa["id"] ? "selected" : NULL ?>> <?php echo $sa["urun_adi"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-label-group mb-3 text-start mt-3  col-6">
                        ÜRÜN ADEDİ *
                        <select name="adet" id="" class="mt-3 col-12 text-center" style="height: 35px;">
                            <?php foreach ($a as $sa) { ?>
                                <option value="<?php echo $sa["id"] ?> " <?php echo $sa["adet"] == $sa["id"] ? "selected" : NULL ?>> <?php echo $sa["adet"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-label-group mb-3 text-start mt-3  col-6" >
                       BİRİM FİYATI *
                        <select name="birim_fiyati" id="" class="mt-3 col-12 text-center" style="height: 35px;">
                            <?php foreach ($a as $sa) { ?>
                                <option value="<?php echo $sa["id"] ?> " <?php echo $sa["birim_fiyati"] == $sa["id"] ? "selected" : NULL ?>> <?php echo $sa["birim_fiyati"] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary mb-3">DÜZENLE</button>
                    </div>

                </div>
            </div>
        </form>
    </div>