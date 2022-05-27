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
    <form class="form-signin bg-light" method="POST" action="kullanici_duzenle_post.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">

        <div class="page">
            <div class="container-tight">

                <form class="card" action="kullanici_duzenle_post.php" method="POST">
                    <div class="card-body">
                        <h3 class="mb-3 " style="color: RED; text-align:center">KULLANICI BİLGİLERİ</h3>
                        <div style="border:outset;border-radius:20px;background-image: radial-gradient(100% 100% at 100% 0px,
            white 0px, gray 100%) !important;text-align: -webkit-center;">
                            <div class="container">
                                <div class="input-group mb-3 mt-5">
                                    <label class="input-group-text " style="color:brown" for="inputGroupSelect01">KULLANICI ADI</label>
                                    <input type="text" value="<?= $duzenle["kullanici_adi"] ?>" class="form-control" name="kullanici_adi" placeholder="kullanici_adi" required autofocus>

                                </div>
                                <div class="input-group mb-3">
                                    <label class="input-group-text" style="color:brown" for="inputGroupSelect02">E POSTA</label>
                                    <input type="text" value="<?= $duzenle["e_posta"] ?>" class="form-control" name="e_posta" placeholder="e_posta" required autofocus>

                                </div>

                                <p class="mb-3 mt-2" style="color: brown;"> ROL SEÇİNİZ * </p>
                                <select class="form-select form-control" name="role_id" aria-label="Default select example">

                                    <?php foreach ($db->query("SELECT * from roller") as $roller) { ?>

                                        <option value="<?php echo $roller["id"] ?>" <?php echo $duzenle["role_id"] == $roller["id"] ? "selected" : NULL ?>>
                                            <?= $roller["role_adi"] . " " ?> </option>

                                    <?php } ?>
                                </select>
                                <p class="mb-3 mt-2" style="color: brown;"> ŞUBE SEÇİNİZ *</p>
                                <select class="form-select" name="sube_id">

                                    <?php foreach ($db->query("SELECT * from kullanici_subeler") as $subeler) { ?>

                                        <option value="<?= $subeler["id"] ?>" <?php echo $duzenle["sube_id"] == $subeler["id"] ? "selected" : NULL ?>>
                                            <?= $subeler["sube_adi"] . " " ?>

                                        </option>

                                    <?php } ?>
                                </select>
                                <div class="input-group mt-4 mb-3">
                                    <label class="input-group-text" style="color:brown" for="inputGroupSelect02">TELEFON NUMARASI</label>
                                    <input type="text" value="<?= $duzenle["tel"] ?>" class="form-control" name="tel" placeholder="tel" required autofocus>

                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary mb-5">DÜZENLE</button>
                                </div>
                            </div>
                </form>
            </div>
        </div>
</div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
</form>
</div>
<script src="./dist/js/tabler.min.js"></script>
<script src="./dist/js/demo.min.js"></script>