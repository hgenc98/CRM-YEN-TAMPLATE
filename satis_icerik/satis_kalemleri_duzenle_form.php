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
    $SELECT = $db->prepare(" SELECT * FROM `satis_kalemleri` WHERE id=?");

    $SELECT->execute([$_GET['id']]);
    $duzenle = $SELECT->fetch();
}
?>
<div class="container" style="text-align: -webkit-center;">
    <?php
    $breadcrumbs = [["link" => "satislar.php", "baslik" => "Satislar"], ["link" => "satis_kalemleri.php", "baslik" => "Satis Kalemleri"], ["link" => "satis_kalemleri_duzenle_form.php?id=" . $_GET["id"], "baslik" => "Satis Kalem Duzenle"]];
    include "../breadcrumb.php"; ?>

    <form class="form-signin w-50" method="POST" action="satis_kalemleri_duzenle_post.php" enctype="multipart/form-data" style="text-align:-webkit-center ;border:solid;border-radius:20px;text-align: -webkit-center;background-color:white">
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <div class="text-center">
            <div class="container mt-4">
                <h3 style="color: red;">SATIŞ KALEMLERİ DÜZENLE</h3>
                <hr>
                <div class="input-group mb-4">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02">ÜRÜN ADI</label>
                    <input type="text" value="<?= $duzenle["urun_adi"] ?>" class="form-control" name="urun_adi" placeholder="urun_adi" required autofocus>

                </div>
                <div class="input-group mb-4">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02">BİRİM FİYATI</label>
                    <input type="text" value="<?= $duzenle["birim_fiyati"] ?>" class="form-control" name="birim_fiyati" placeholder="birim_fiyati" required autofocus>

                </div>
                <div class="input-group mb-4">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02">ÜRÜN ADEDİ</label>
                    <input type="text" value="<?= $duzenle["adet"] ?>" class="form-control" name="adet" placeholder="adet" required autofocus>

                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary mb-3">DÜZENLE</button>
                </div>
            </div>
        </div>
    </form>
</div>