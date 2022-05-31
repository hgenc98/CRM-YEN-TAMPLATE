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
        <form class="form-signin mt-5 w-50 page" method="post" action="musteri_duzenle_post.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
            <div class="container col-12  " style="background-color:white;border: 1px solid var(--tblr-border-color);border-radius: 4px;">
                <div class="row">
                    <div style="text-align:-webkit-center;">
                        <h1 style="color:brown" class="h3 mb-3 mt-3 font-weight-normal">MÜŞTERİ DÜZENLEMEK İÇİN </h1>
                        <p style="color:brown">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
                    </div>
                    <hr>
                    <div class="form-label-group mb-3 text-start mt-3  col-6">
                        MÜŞTERİ ADI SOYADI *
                        <input type="text" value="<?= $duzenle["musteri_adi"] ?>" class="mt-3 form-control" name="musteri_adi" placeholder="musteri_adi" required autofocus>

                    </div>

                    <div class="form-label-group mb-3 text-start mt-3  col-6">
                        MÜŞTERİ ELEMAN ADI *
                        <select name="eleman_adi" id="" class="mt-3 col-12" style="height: 35px;">
                            <?php foreach ($elemanlar as $eleman) { ?>
                                <option value="<?php echo $eleman["eleman_adi"] ?>" <?php echo $eleman["eleman_adi"] == $eleman["id"] ? "selected" : NULL ?>> <?php echo $eleman["eleman_adi"] ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="form-label-group mb-3 text-start mt-3  ">
                        MÜŞTERİ TELEFON NO *
                        <input type="text" value="<?= $duzenle["telefon_no"] ?>" class="mt-3 form-control" name="telefon_no" placeholder="telefon_no" required autofocus>

                    </div>
                    <div class="input-group ">
                        <h4 class="mt-3"> MÜŞTERİ ADRESİ *</h4>
                        <textarea name="aciklama" id="editor1" class="ck_editor mt-3" style="width: 480px;"><?= $duzenle["adres"] ?></textarea>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary mb-3">DÜZENLE</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
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