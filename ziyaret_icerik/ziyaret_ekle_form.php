<?php
include "../header.php";
include "../db.php";
include "islem.php";

if ($_POST) {
    echo "sfsdf" . $_POST['musteri_id'];
}

$musteri = $db->query('SELECT * FROM musteriler WHERE  musteriler.firma_id =' . $_SESSION["firma_id"] . '')->fetchAll();
?>
<div class="container page">
    <?php
    $breadcrumbs = [["link" => "ziyaret.php", "baslik" => "Ziyaret"], ["link" => "ziyaret_ekle_form.php", "baslik" => "Ziyaret Ekle"]];
    include "../breadcrumb.php"; ?>
    <div style="text-align: -webkit-center;">
        <form class="form-signin w-50 " method="post" action="ziyaret_ekle_post.php" enctype="multipart/form-data">
            <div class="container" style="text-align:-webkit-center ;border:solid;border-radius:20px;background-color:white">
                <div>
                    <h1 style="color:brown" class=" mb-3 font-weight-normal mt-4">ZİYARET EKLEMEK İÇİN </h1>
                    <p style="color:brown ;text-align:center">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
                </div>
                <hr>
                <div class="form-label-group mt-4">
                    TAMAMLAYACAK KİŞİ (PERSONEL) *
                    <select class="form-select form-control " name="tamamlayan_id" aria-label="Default select example">
                        <option selected>SORUMLU SEÇİNİZ</option>
                        <?php foreach ($db->query('SELECT * from kullanicilar  WHERE  kullanicilar.firma_id =' . $_SESSION["firma_id"] . '') as $kullanici) { ?>

                            <option value="<?php echo $kullanici["id"] ?>">
                                <?= $kullanici["kullanici_adi"] . " " ?></option>

                        <?php } ?>
                    </select>
                </div>
                <div class="form-label-group  mt-4">
                    MÜŞTERİ ADI SOYADI *
                    <select name="musteri_adi" id='musteri' class="form-select form-control">
                        <option selected>SORUMLU SEÇİNİZ</option>
                        <?php
                        foreach ($musteri as $mstr) { ?>
                            <option value="<?php echo $mstr['id'] ?>"><?php echo $mstr['musteri_adi'] ?></option>
                        <?php  }
                        ?>
                    </select>
                </div>
                <div class="mt-4">
                    MÜŞTERİ ELEMAN ADI *
                    <select name="musteri_eleman_id" id="musteri_eleman" class="form-select form-control">
                   
                    </select>
                </div>
                <div class="form-label-group mt-4">
                    MÜŞTERİ TELEFON NUMARASI *
                    <input type="text" class="form-control" name="tel_no" placeholder="telefon_no" id='telefon_no' required="">
                </div>
                <div class="form-label-group mt-4">
                    ADRES *
                    <input type="text" class="form-control" name="musteri_adres" placeholder="adres" id='adres' required="">
                </div>


                <div class="form-label-group mt-4">
                    TAMAMLANMA TARİHİ *
                    <input type="datetime-local" class="form-control" name="tamamlanacak_tarih" placeholder="tamamlanan_tarih" required="">
                </div>


                <div style="width:35%;height:36px" class="mt-4">
                    AÇIKLAMA
                    <textarea name="aciklama" id="editor1" class="ck_editor"></textarea>
                </div>
                <div class="mt-5">
                    <input type="checkbox" name="durum" class="btn-check ml-3" id="btn-check-3" autocomplete="off" disabled>
                    <label class="btn btn-primary" name="durum" for="btn-check-3">TAMAMLANMADI</label>

                    <button type="submit" class="btn btn-primary mb-3 mt-3">DÜZENLE</button>
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
<script>
    $('#musteri').on('change', function() {
        var musteri_id = $('#musteri').val();
        $.ajax({
            'type': 'POST',
            'url': 'islem.php',
            'data': {
                'selected': musteri_id,
            },
            'success': function(item) {
                $('#musteri_eleman').empty();
                var data = JSON.parse(item);
                console.log(data);
                var musteri_eleman = $('#musteri_eleman').val();
                data[0].map(e => {
                    $('#musteri_eleman').append(
                        `<option value="${e.id}">${e.eleman_adi}</option>`
                    );
                });
                $('#adres').val(data[1]['adres']);
                $('#telefon_no').val(data[1]['telefon_no']);

            }
        });

    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>