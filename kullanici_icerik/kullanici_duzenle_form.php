<?php
include "../db.php";
include "../header.php";


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
<div class="container">
    <?php
    $breadcrumbs = [["link" => "kullanici.php", "baslik" => "Kullanici"], ["link" => "kullanici_icerik/kullanici_duzenle_form.php?id=" . $_GET["id"], "baslik" => "Kullanici Duzenle"]];
    include "../breadcrumb.php"; ?>
    <form class="form-signin " method="POST" action="kullanici_duzenle_post.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">

        <div class="page">
            <div class="container">

                <form action="kullanici_duzenle_post.php" method="POST">
                   
                        <div class="container w-50 col-12 " style="background-color:white;border: 1px solid var(--tblr-border-color);border-radius: 4px;">
                            <div class="row">
                                <h3 class="mb-3 text-danger mt-3" style=" text-align:center">KULLANICI DÜZENLE</h3>
                                <hr>
                                <div class="form-label-group mb-3 text-start mt-3 col-6">
                                    KULLANICI ADI *
                                    <input type="text" value="<?= $duzenle["kullanici_adi"] ?>" class="form-control mt-3" name="kullanici_adi" placeholder="kullanici_adi" required autofocus>

                                </div>
                                <div class="form-label-group mb-3 text-start mt-3 col-6">
                                    E POSTA *
                                    <input type="text" value="<?= $duzenle["e_posta"] ?>" class="form-control mt-3" name="e_posta" placeholder="e_posta" required autofocus>

                                </div>
                                <div class="form-label-group mb-3 text-start mt-3 col-6">
                                    <p class=" mt-3 col-6"> ROL SEÇİNİZ * </p>
                                    <select class="form-select form-control" name="role_id" aria-label="Default select example">

                                        <?php foreach ($db->query("SELECT * from roller") as $roller) { ?>

                                            <option value="<?php echo $roller["id"] ?>" <?php echo $duzenle["role_id"] == $roller["id"] ? "selected" : NULL ?>>
                                                <?= $roller["role_adi"] . " " ?> </option>

                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-label-group mb-3 text-start mt-3 col-6">
                                    <p class=" mt-3 col-6"> ŞUBE SEÇİNİZ *</p>
                                    <select class="form-select form-label-group mb-3 text-start mt-3 col-6" name="sube_id">

                                        <?php foreach ($db->query("SELECT * from kullanici_subeler") as $subeler) { ?>

                                            <option value="<?= $subeler["id"] ?>" <?php echo $duzenle["sube_id"] == $subeler["id"] ? "selected" : NULL ?>>
                                                <?= $subeler["sube_adi"] . " " ?>

                                            </option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-label-group mb-3  mt-3 " style="text-align:-webkit-center">
                                <div class="form-label-group mb-3  mt-3 ">
                                TELEFON NUMARASI *
                                <input type="text" value="<?= $duzenle["tel"] ?>" class="form-control" name="tel" placeholder="tel" required autofocus>

                            </div>
                            
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary mb-3">DÜZENLE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</form>