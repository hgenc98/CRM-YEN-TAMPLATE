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
        <form class="form-signin bg-light mt-5 w-50" method="POST" action="kullanici_sube_duzenle_post.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
            <div class="container col-12 " style="background-color:white;border: 1px solid var(--tblr-border-color);border-radius: 4px;">
                <div class="row">
                        <h3 class="text-danger mt-3" >KULLANICI ŞUBE BİLGİLERİ </h3>
                        <hr>
                     
                            <div  class="form-label-group mb-3 text-start mt-3 col-6">
                                ŞUBE ADI *
                                <input type="text" value="<?= $duzenle["sube_adi"] ?>" class="form-control mt-3" name="sube_adi" placeholder="sube_adi" required autofocus>
                            </div>
                            <div class="form-label-group mb-3 text-start mt-3 col-6">
                              YETKİLİ ADI SOYADI *
                                <input type="text" value="<?= $duzenle["yetkili_adi"] ?>" class="form-control mt-3" name="yetkili_adi" placeholder="yetkili_adi" required autofocus>
                            </div>
                            <div  class="form-label-group mb-3 text-start mt-3 col-6">
                                 YETKİLİ TELEFON NUMARASI *
                                <input type="text" value="<?= $duzenle["yetkili_telefon"] ?>" class="form-control mt-3" name="yetkili_telefon" placeholder="yetkili_telefon" required autofocus>
                            </div>
                            <div  class="form-label-group mb-3 text-start mt-3 col-6">
                                E POSTA *
                                <input type="email" value="<?= $duzenle["e_posta"] ?>" class="form-control mt-3" name="e_posta" placeholder="e_posta" required autofocus>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary mb-3">DÜZENLE</button>
                            </div>

                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>