<?php
include "../header.php";
include "../db.php";
include "../islem2.php";


$duzenle = null;
$baglanti = null;
if ($_GET) {
    $SELECT = $db->prepare(" SELECT * FROM `musteri_eleman` WHERE id=?");

    $SELECT->execute([$_GET['id']]);
    $duzenle = $SELECT->fetch();
}
?>
<div class="container page">
    <?php
    $breadcrumbs = [["link" => "musteriler.php", "baslik" => "Musteriler"], ["link" => "musteri_eleman_duzenle_form.php?id=" . $_GET["id"], "baslik" => "Musteri Eleman Duzenle"]];
    include "../breadcrumb.php"; ?>

    <form class="form-signin container w-50" method="post" action="musteri_eleman_duzenle_post.php" enctype="multipart/form-data"style="text-align:-webkit-center ;border:solid;border-radius:20px;text-align: -webkit-center;background-color:white">
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <div>
            <h1 style="color:brown" class="h3 mb-3 mt-4 font-weight-normal">MÜŞTERİ ELEMAN DÜZENLEMEK İÇİN </h1>
            <p style="color:brown;text-align:center">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
        </div>
<hr>
        <div class="input-group mb-4">
            <label class="input-group-text" style="color:black" for="inputGroupSelect02">ELEMAN ADI SOYADI *</label>
            <input type="text" value="<?= $duzenle["eleman_adi"] ?>" class="form-control" name="eleman_adi" placeholder="eleman_adi" required autofocus>

        </div>

        <div class="input-group mb-4">
            <label class="input-group-text" style="color:black" for="inputGroupSelect02">E POSTA *</label>
            <input type="text" value="<?= $duzenle["e_posta"] ?>" class="form-control" name="e_posta" placeholder="e_posta" required autofocus>

        </div>
        <div class="input-group mb-4">
            <label class="input-group-text" style="color:black" for="inputGroupSelect05"> TELEFON NO *</label>
            <input type="text" value="<?= $duzenle["telefon_no"] ?>" class="form-control" name="telefon_no" placeholder="telefon_no" required autofocus>

        </div>
        <div style="color:black">
            <label class="input-group-text" style="color:black" for="inputGroupSelect02"> SORUMLU ADI SOYADI *
                <select class="form-select form-control ml-3" name="musteri_id" aria-label="Default select example">
                    <option>SORUMLU SEÇİNİZ</option>
                    <?php foreach ($db->query("SELECT * from musteriler") as $musteriler) { ?>
                        <option <?php echo $musteriler['id'] == $duzenle['musteri_id'] ? "selected" : null ?> value="<?php echo $musteriler["id"] ?>">
                            <?= $musteriler["musteri_adi"] . " " ?></option>
                    <?php } ?>
                </select>
            </label>
        </div>
        <div class="input-group mb-4 mt-4">
            <label class="input-group-text" style="color:black" for="inputGroupSelect02"> ÜNVAN *</label>
            <input type="text" value="<?= $duzenle["unvan"] ?>" class="form-control" name="unvan" placeholder="unvan" required autofocus>

        </div>

        <button class="mb-5" type="submit" style="border:4px outset, ; border-radius:10px;background-image: radial-gradient(100% 100% at 100% 0px,
            rgb(90, 218, 255) 0px, rgb(84, 104, 255) 100%) !important; width: 50%;">
            EKLE
        </button>
    </form>
    <div class="mb-5"></div>
</div>