<?php
include "../header.php";
include "../db.php";

try {
    //echo "Veri çekme işlemi";

} catch (PDOException $e) {
    die($e->getMessage());
}
$duzenle = null;
$baglanti = null;
if ($_GET) {
    $SELECT = $db->prepare(" SELECT * FROM `kullanicilar` WHERE id=?");

    $SELECT->execute([$_GET['id']]);
    $duzenle = $SELECT->fetch();
}
?>

<div class="page container">
    <?php
    $breadcrumbs = [["link" => "ayarlar.php", "baslik" => "Ayarlar"]];
    include "../breadcrumb.php"; ?>
    <form action="ayarlar_post.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $_SESSION['kullanici']['id']; ?>">
        <div style="text-align:-webkit-center">
            <div class="container w-50 col-12 " style="background-color:white;border: 1px solid var(--tblr-border-color);
                              border-radius: 4px;">
                <div class="row">
                    <div style="border-bottom: 1px solid #444;">
                        <h1 style="color:brown" class="h3 mb-3 mt-3 font-weight-normal"> KULLANICI AYARLARI </h1>
                        <p style="color:brown;text-align:center">Lütfen gerekli belgeleri kontrol doldurunuz !! </p>
                    </div>

                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        ADI SOYADI *
                        <input type="text" value="<?= $_SESSION['kullanici']['kullanici_adi'];  ?>" class="form-control mt-3" name="kullanici_adi" placeholder="kullanici_adi" required autofocus>

                    </div>
                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        E POSTA *
                        <input type="text" value="<?= $_SESSION['kullanici']['e_posta']; ?>" class="form-control mt-3" name="e_posta" placeholder="e_posta" required autofocus>
                    </div>

                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                    TELEFON NUMARASI *
                        <input type="text" value="<?= $_SESSION['kullanici']['tel']; ?>" class="form-control mt-3" name="tel" placeholder="tel" required autofocus>

                    </div>
                   

                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        <p class=" col-6"> ŞUBE SEÇİNİZ *</p>
                        <select class="form-select form-label-grouptext-start mt-3 col-6" name="sube_id">

                            <?php foreach ($db->query("SELECT * from kullanici_subeler") as $subeler) { ?>

                                <option value="<?= $subeler["id"] ?>" <?php echo $_SESSION['kullanici']['sube_id'] == $subeler["id"] ? "selected" : NULL ?>>
                                    <?= $subeler["sube_adi"] . " " ?>

                                </option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        YENİ ŞİFRE GİRİNİZ *
                        <input type="pasword" class="form-control  mt-3" name="sifre" placeholder="sifre" required="">
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary mb-3">DEĞİŞTİR</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>