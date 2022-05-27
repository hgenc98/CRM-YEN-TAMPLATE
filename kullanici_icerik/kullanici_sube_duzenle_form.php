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
    $SELECT = $db->prepare(" SELECT * FROM `kullanici_subeler` WHERE id=?");

    $SELECT->execute([$_GET['id']]);
    $duzenle = $SELECT->fetch();
}
?>
<div class="page">
    <div class="container" style="text-align: -webkit-center;">
        <?php
        $breadcrumbs = [["link" => "kullanici_subeler.php", "baslik" => "Kullanici Subeler"], ["link" => "kullanici_duzenle_form.php?id=" . $_GET["id"], "baslik" => "Kullanici Sube Duzenle"]];
        include "../breadcrumb.php"; ?>
        <form class="form-signin bg-light mt-5 w-50" method="POST" action="kullanici_sube_duzenle_post.php" enctype="multipart/form-data" style="border: 1px solid gray;border-radius:20px;background-image: radial-gradient(100% 100% at 100% 0px,
            white 0px, gray 100%) !important;">
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">

            <div class=" mt-3" style="text-align: -webkit-center;">
                <h3 style="color: brown;">KULLANICI ŞUBE BİLGİLERİ </h3>
                <hr>
                <div class="w-50">
                    <div class="input-group mb-4">
                        <label class="input-group-text" style="color:black" for="inputGroupSelect01">ŞUBE ADI</label>
                        <input type="text" value="<?= $duzenle["sube_adi"] ?>" class="form-control" name="sube_adi" placeholder="sube_adi" required autofocus>
                    </div>
                    <div class="input-group mb-4">
                        <label class="input-group-text" style="color:black" for="inputGroupSelect02">YETKİLİ ADI SOYADI</label>
                        <input type="text" value="<?= $duzenle["yetkili_adi"] ?>" class="form-control" name="yetkili_adi" placeholder="yetkili_adi" required autofocus>
                    </div>
                    <div class="input-group mb-4">
                        <label class="input-group-text" style="color:black" for="inputGroupSelect02"> YETKİLİ TELEFON NUMARASI</label>
                        <input type="text" value="<?= $duzenle["yetkili_telefon"] ?>" class="form-control" name="yetkili_telefon" placeholder="yetkili_telefon" required autofocus>
                    </div>
                    <div class="input-group mb-4">
                        <label class="input-group-text" style="color:black" for="inputGroupSelect02">E POSTA</label>
                        <input type="email" value="<?= $duzenle["e_posta"] ?>" class="form-control" name="e_posta" placeholder="e_posta" required autofocus>
                    </div>
                    <div style="text-align:center;" class="mb-5">
                        <button type="submit" style="border:4px outset, ; border-radius:10px;background-image: radial-gradient(100% 100% at 100% 0px,
                    rgb(90, 218, 255) 0px, rgb(84, 104, 255) 100%) !important; width: 50%;">
                            GÜNCELLE
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="../dist/js/tabler.min.js"></script>
<script src="../dist/js/demo.min.js"></script>