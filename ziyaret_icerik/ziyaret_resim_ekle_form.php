<?php
include "../db.php";
include "../header.php";


$sql = $db->query('SELECT ziyaret_resim.*, ziyaretler.tamamlayan_id FROM ziyaret_resim
LEFT JOIN ziyaretler  on tamamlayan_id = ziyaret_id');
$db = $sql->execute(['id']);
?>


<div class="col-md-8">
  <div style="border: 3px solid red;border-radius:5px;justify-content:center">
    <div class="row">
      <h2 class="mt-3" style="color:red">RESİM EKLE</h2>

      <form action="ziyaret_icerik/ziyaret_resim_ekle_post.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <div class="form-label-group">
            <p style="color:white">ZİYARET YERİ *</p>
            <input type="text" class="form-control col-5" name="tamamlayan_id" placeholder="" required="" autofocus="">
          </div>
          <label for="exampleFormControlFile1">RESSİM EKLE</label>
          <input type="file" class="form-control-file" id="exampleFormControlFile1" name="resim">
        </div>
        <div> <input type="submit" value="gönder"></div>
      </form>
    </div>
  </div>
</div>