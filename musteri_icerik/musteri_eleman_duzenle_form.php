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
<div class="container ">
    <?php
    $breadcrumbs = [["link" => "musteriler.php", "baslik" => "Musteriler"], ["link" => "musteri_eleman_duzenle_form.php?id=" . $_GET["id"], "baslik" => "Musteri Eleman Duzenle"]];
    include "../breadcrumb.php"; ?>

    <form class="form-signin container page w-50" method="post" action="musteri_eleman_duzenle_post.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <div class="container col-12  " style="background-color:white;border: 1px solid var(--tblr-border-color);border-radius: 4px;">
            <div class="row">
                <div>
                    <h1 class="text-danger text-center h3 mb-3 mt-4 font-weight-normal">MÜŞTERİ ELEMAN DÜZENLE </h1>
                    <p style="text-align:center">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
                </div>
                <hr>
                <div class="form-label-group mb-3 text-start mt-3  col-6">
                    ELEMAN ADI SOYADI *
                    <input type="text" value="<?= $duzenle["eleman_adi"] ?>" class="form-control mt-3" name="eleman_adi" placeholder="eleman_adi" required autofocus>

                </div>

                <div class="form-label-group mb-3 text-start mt-3 col-6">
                    E POSTA *
                    <input type="text" value="<?= $duzenle["e_posta"] ?>" class="form-control mt-3" name="e_posta" placeholder="e_posta" required autofocus>

                </div>
                <div class="form-label-group mb-3 text-start mt-3 col-6">
                    TELEFON NO *
                    <input type="text" value="<?= $duzenle["telefon_no"] ?>" class="form-control mt-3" name="telefon_no" placeholder="telefon_no" required autofocus>

                </div>
                <div class="form-label-group mb-3 text-start mt-3 col-6">
                    SORUMLU ADI SOYADI *
                        <select class="form-select form-control ml-3 mt-3" name="musteri_id" aria-label="Default select example">
                            <option>SORUMLU SEÇİNİZ</option>
                            <?php foreach ($db->query("SELECT * from musteriler") as $musteriler) { ?>
                                <option <?php echo $musteriler['id'] == $duzenle['musteri_id'] ? "selected" : null ?> value="<?php echo $musteriler["id"] ?>">
                                    <?= $musteriler["musteri_adi"] . " " ?></option>
                            <?php } ?>
                        </select>
                    </label>
                </div>
                <div class="form-label-group mb-3 text-start mt-3 ">
                     ÜNVAN *
                    <input type="text" value="<?= $duzenle["unvan"] ?>" class="form-control mt-3" name="unvan" placeholder="unvan" required autofocus>

                </div>

                <div class="form-footer text-center">
                    <button type="submit" class="btn btn-primary mb-3">DÜZENLE</button>
                </div>

            </div>
        </div>
    </form>


</div>