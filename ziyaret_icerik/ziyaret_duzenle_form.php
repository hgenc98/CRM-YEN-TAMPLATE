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
        <div style="text-align:-webkit-center ">

            <div class="w-50 container" style="text-align:-webkit-center ;border:solid;border-radius:20px;text-align: -webkit-center;background-color:white">
                <h3 style=" color: black;"class="mt-4">ZİYARET BİLGİLERİNİ DÜZENLE</h3>
                <hr>
                <?php
                $rol = $_SESSION['rol'];
                if ($rol == 1) { ?>
                    <div class="input-group mb-3">
                        <label class="input-group-text mb-4" style="color:black" for="inputGroupSelect01">TAMAMLAYAN KİŞİ </label>
                        <select name="tamamlayan_id" id="" style="width:35%;height:36px">
                            <?php foreach ($kullanicilar as $kullanici) { ?>
                                <option value="<?php echo $kullanici["id"] ?> " <?php echo $duzenle["tamamlayan_id"] == $kullanici["id"] ? "selected" : NULL ?>> <?php echo $kullanici["kullanici_adi"] ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="input-group mb-2">
                        <label class="input-group-text mb-4" style="color:black;width:31%" for="inputGroupSelect02">MÜŞTERİ ADI </label>
                        <select name="musteri_id" id="" style="width:35%;height:36px">
                            <?php foreach ($musteriler as $musteri) {
                            ?>
                                <option value="<?php echo $musteri["id"] ?>" <?php echo $duzenle["musteri_id"] == $musteri["id"] ? "selected" : NULL ?>> <?php echo $musteri["musteri_adi"] ?> </option>

                            <?php } ?>
                        </select>


                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text mb-4" style="color:black" for="inputGroupSelect02"> MÜŞTERİ ELEMAN ADI</label>
                        <select name="musteri_eleman_id" id="" style="width:31%;height:36px">
                            <?php foreach ($eleman as $eleman) { ?>
                                <option value="<?php echo $eleman["id"] ?> " <?php echo $duzenle["musteri_eleman_id"] == $eleman["id"] ? "selected" : NULL ?>> <?php echo $eleman["eleman_adi"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-group mb-4">
                        <label class="input-group-text" style="color:black" for="inputGroupSelect02">MÜŞTERİ TELEFON NUMARASI</label>
                        <input style="width:31%;height:36px" type="text" value="<?= $duzenle["tel_no"] ?>" class="form-control" name="tel_no" placeholder="tel_no" required autofocus>
                    </div>
                    <div class="input-group mb-4">
                        <label class="input-group-text" style="color:black" for="inputGroupSelect02">TAMAMLANACAK TARİH</label>
                        <input type="date-time" value="<?= $duzenle["tamamlanacak_tarih"] ?>" class="form-control" name="tamamlanacak_tarih" placeholder="tamamlanacak_tarih" required autofocus>
                    </div>
                <?php }
                ?>
                <div class="input-group mb-4">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02">MÜŞTERİ ADRES</label>
                    <input type="text" value="<?= $duzenle["musteri_adres"] ?>" class="form-control" name="musteri_adres" placeholder="musteri_adres" required autofocus>
                </div>
                <div class="input-group mb-4">
                    <h3 style="color: black;text-align:-webkit-center"> AÇIKLAMA *</h3>
                    <textarea name="aciklama" id="editor1" class="ck_editor" style="width: 480px;"><?= $duzenle["aciklama"] ?></textarea>
                </div>
                <div class="form-footer">
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