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
        <form class="form-signin w-50" method="POST" action="satis_duzenle_post.php" enctype="multipart/form-data" style="text-align:-webkit-center ;border:solid;border-radius:20px;text-align: -webkit-center;background-color:white">
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
            <div style="text-align:-webkit-center">

                <h3 class="mt-3 mb-4" style="color: red;">SATIŞ DÜZENLE</h3>
                <hr>
                <div class="input-group mb-4" style="width:60%">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect01">MÜŞTERİ ADI</label>
                    <select name="musteri_id" id="">
                        <?php foreach ($musteriler as $musteri) {
                        ?>
                            <option value="<?php echo $musteri["id"] ?>" <?php echo $duzenle["musteri_id"] == $musteri["id"] ? "selected" : NULL ?>> <?php echo $musteri["musteri_adi"] ?> </option>

                        <?php } ?>
                    </select>
                </div>
                <div class="input-group mb-4" style="width:61%">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02">KULLANICI ADI SOYADI</label>
                    <select name="kullanici_id" id="">
                        <?php foreach ($kullanicilar as $kullanici) { ?>
                            <option value="<?php echo $kullanici["id"] ?> " <?php echo $duzenle["kullanici_id"] == $kullanici["id"] ? "selected" : NULL ?>> <?php echo $kullanici["kullanici_adi"] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-group mb-4" style="width:60%">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02"> SATIŞ TARİHİ</label>
                    <input type="datetime-local" value="<?= $duzenle["satis_tarihi"] ?>" class="form-control" name="satis_tarihi" placeholder="satis_tarihi" required autofocus>
                </div>
                <div class="input-group mb-4" style="width:60%">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02">ÜRÜN ADI</label>

                    <select name="urun_adi" id="">
                        <?php foreach ($a as $sa) { ?>
                            <option value="<?php echo $sa["id"] ?> " <?php echo $sa["urun_adi"] == $sa["id"] ? "selected" : NULL ?>> <?php echo $sa["urun_adi"] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-group mb-4" style="width:60%">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02">ÜRÜN ADEDİ</label>
                    <select name="adet" id="">
                        <?php foreach ($a as $sa) { ?>
                            <option value="<?php echo $sa["id"] ?> " <?php echo $sa["adet"] == $sa["id"] ? "selected" : NULL ?>> <?php echo $sa["adet"] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-group mb-4" style="width:60%">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02">BİRİM FİYATI</label>
                    <select name="birim_fiyati" id="">
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