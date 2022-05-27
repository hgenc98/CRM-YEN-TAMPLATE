<?php
include "../db.php";
include "../header.php";
include "../islem2.php";

$duzenle = null;
$baglanti = null;
if ($_GET) {
    $SELECT = $db->prepare(" SELECT * FROM ziyaret_notu WHERE id=?");

    $SELECT->execute([$_GET['id']]);
    $duzenle = $SELECT->fetch();
   
}

$breadcrumbs = [["link"=>"ziyaret_icerik/ziyaret.php","baslik"=>"Ziyaret"],["link"=>"ziyaret_icerik/ziyaret_aciklama_detay.php?id=". $_GET["id"],"baslik"=>"Ziyaret Aciklama Detay"],["link"=>"ziyaret_icerik/ziyaret_notu_duzenle_form.php?id=". $_GET["id"],"baslik"=>"Ziyaret Notu Duzenle"]];
include "../breadcrumb.php"; ?>

<form class="form-signin" method="POST" action="ziyaret_icerik/ziyaret_notu_duzenle_post.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
    <div class="text-center ">

        <div style="margin-top:50px" class="row ">
            <h3 style="color: black;">ZİYARET NOTU DÜZENLE</h3>
            <hr>


            <div class="col-md-6">
                <div class="" style="width: 480px;color:white;text-align:center">
               
                <textarea name="aciklama" id="editor1" class="ck_editor" style="width: 480px;"><?=$duzenle["aciklama"] ?></textarea>
                </textarea>

                </div>
            </div>
        </div>
        <button class="mt-5" style="border:4px outset, ; border-radius:10px;background: radial-gradient(100% 100% at 100% 0px,
            rgb(90, 218, 255) 0px, rgb(84, 104, 255) 100%) !important; width: 50%;">
            GÜNCELLE
        </button>
    </div>
    </div>
</form>


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