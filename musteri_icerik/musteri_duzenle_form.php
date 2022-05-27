<?php
include "../header.php";
include "../db.php";
include "../islem2.php";


$duzenle = null;
$baglanti = null;
if ($_GET) {
    $SELECT = $db->prepare(" SELECT * FROM `musteriler` WHERE id=?");
    $SELECT->execute([$_GET['id']]);
    $duzenle = $SELECT->fetch();
    $elemanlar = $db->query(" SELECT * FROM `musteri_eleman`");

    $elemanlar = $elemanlar->fetchAll();
}
?>
<div class="container page">
    <?php
    $breadcrumbs = [["link" => "musteriler.php", "baslik" => "Musteriler"], ["link" => "musteri_duzenle_form.php?id=" . $_GET["id"], "baslik" => "Musteri Duzenle"]];
    include "../breadcrumb.php"; ?>
    <div style="text-align:-webkit-center;">
        <form class="form-signin mt-5 w-50" method="post" action="musteri_duzenle_post.php" enctype="multipart/form-data" style="text-align:-webkit-center ;border:solid;border-radius:20px;text-align: -webkit-center;background-color:white">
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
            <div class="container">
                <div style="text-align:-webkit-center;">
                    <h1 style="color:brown" class="h3 mb-3 mt-3 font-weight-normal">MÜŞTERİ DÜZENLEMEK İÇİN </h1>
                    <p style="color:brown">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
                </div>
                <hr>
                <div class="input-group mb-4">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02">MÜŞTERİ ADI SOYADI *</label>
                    <input type="text" value="<?= $duzenle["musteri_adi"] ?>" class="form-control" name="musteri_adi" placeholder="musteri_adi" required autofocus>

                </div>

                <div class="input-group mb-4">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02">MÜŞTERİ ELEMAN ADI *</label>
                    <select name="eleman_adi" id="">
                        <?php foreach ($elemanlar as $eleman) { ?>
                            <option value="<?php echo $eleman["eleman_adi"] ?>" <?php echo $eleman["eleman_adi"] == $eleman["id"] ? "selected" : NULL ?>> <?php echo $eleman["eleman_adi"] ?></option>
                        <?php } ?>
                    </select>

                </div>
                <div class="input-group mb-4 ">
                    <label class="input-group-text" style="color:black" for="inputGroupSelect02">MÜŞTERİ TELEFON NO *</label>
                    <input type="text" value="<?= $duzenle["telefon_no"] ?>" class="form-control" name="telefon_no" placeholder="telefon_no" required autofocus>

                </div>
                <div class="input-group ">
                    <h4 style="color: black;"> MÜŞTERİ ADRESİ *</h4>
                    <textarea name="aciklama" id="editor1" class="ck_editor" style="width: 480px;"><?= $duzenle["adres"] ?></textarea>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary mb-3">DÜZENLE</button>
                </div>

            </div>
        </form>
    </div>
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