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
    $SELECT = $db->prepare(" SELECT * FROM `ziyaretler` WHERE id=?");
    $notlar = $db->query(" SELECT * FROM `ziyaret_notu` ")->fetch();
    $musteriler = $db->query(" SELECT * FROM `musteriler`")->fetchAll();
    $kullanicilar = $db->query(" SELECT * FROM `kullanicilar`")->fetchAll();
    $eleman = $db->query(" SELECT * FROM `musteri_eleman`")->fetchAll();
    /*var_dump($notlar);
die;*/
    $SELECT->execute([$_GET['id']]);
    $duzenle = $SELECT->fetch();
}
?>
<div class="container page">
    <?php
    $breadcrumbs = [["link" => "ziyaret.php", "baslik" => "Ziyaret"], ["link" => "ziyaret_duzenle_form.php?id=" . $_GET["id"], "baslik" => "Ziyaret Duzenle"]];
    include "../breadcrumb.php";
    ?>
    <form class="form-signin" method="POST" action="ziyaret_duzenle_post.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <div class="container w-50 col-12  " style="background-color:white;border: 1px solid var(--tblr-border-color);border-radius: 4px;">
            <div class="row">
                <h3 class="text-danger text-center mt-4">ZİYARET BİLGİLERİNİ DÜZENLE</h3>
                <hr>
                <?php
                $rol = $_SESSION['rol'];
                if ($rol == 1) { ?>
                    <div class="form-label-group mb-3  mt-3  col-6">
                        TAMAMLAYAN KİŞİ *
                        <select name="tamamlayan_id" class="form-select form-control ml-3 mt-3"style="height: 35px;">
                            <?php foreach ($kullanicilar as $kullanici) { ?>
                                <option value="<?php echo $kullanici["id"] ?> " <?php echo $duzenle["tamamlayan_id"] == $kullanici["id"] ? "selected" : NULL ?>> <?php echo $kullanici["kullanici_adi"] ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="form-label-group mb-3 text-start mt-3  col-6">
                        MÜŞTERİMİZİN ADI *
                        <select name="musteri_id" class="form-select form-control ml-3 mt-3" style="height:35px">
                            <?php foreach ($musteriler as $musteri) {
                            ?>
                                <option value="<?php echo $musteri["id"] ?>" <?php echo $duzenle["musteri_id"] == $musteri["id"] ? "selected" : NULL ?>> <?php echo $musteri["musteri_adi"] ?> </option>

                            <?php } ?>
                        </select>


                    </div>
                    <div class="form-label-group mb-3 text-start mt-3  col-6">
                        MÜŞTERİ ELEMAN ADI *
                        <select name="musteri_eleman_id" class="form-select form-control ml-3 mt-3"style="height:35px">
                            <?php foreach ($eleman as $eleman) { ?>
                                <option value="<?php echo $eleman["id"] ?> " <?php echo $duzenle["musteri_eleman_id"] == $eleman["id"] ? "selected" : NULL ?>> <?php echo $eleman["eleman_adi"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-label-group mb-3 text-start mt-3  col-6">
                        MÜŞTERİ TELEFON NUMARASI *
                        <input style="height:35px" type="text" value="<?= $duzenle["tel_no"] ?>" class="form-control mt-3 " name="tel_no" placeholder="tel_no" required autofocus>
                    </div>
                    <div class="form-label-group mb-3 text-start mt-3  col-6">
                        TAMAMLANACAK TARİH *
                        <input type="date-time" value="<?= $duzenle["tamamlanacak_tarih"] ?>" class="form-control mt-3"  name="tamamlanacak_tarih" placeholder="tamamlanacak_tarih" required autofocus>
                    </div>
                <?php }
                ?>
                <div class="form-label-group mb-3 text-start mt-3  col-6">
                    MÜŞTERİ ADRES *
                    <input type="text" value="<?= $duzenle["musteri_adres"] ?>" class="form-control mt-3" name="musteri_adres" placeholder="musteri_adres" required autofocus>
                </div>
                <div class="form-label-group mb-3 text-start mt-3 ">
                    <h3 style="color: black;text-align:-webkit-center"> AÇIKLAMA *</h3>
                    <textarea name="aciklama" id="editor1" class="ck_editor" style="width: 480px;"><?= $duzenle["aciklama"] ?></textarea>
                </div>
                <div class="form-footer text-center">
                    <button type="submit" class="btn btn-primary mb-3">DÜZENLE</button>
                </div>
            </div>

        </div>
</div>
</form>
</div>
<script>
    $(document).ready(function() {
        $(".ck_editor").each(function(index) {
            var input_name = $(this).attr("name");
            CKEDITOR.replace(input_name);
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>