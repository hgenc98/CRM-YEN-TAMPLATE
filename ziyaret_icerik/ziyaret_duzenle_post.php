<?php
include "../db.php";
if ($_POST) {

try {
    $sorgu = $db->prepare("UPDATE ziyaretler set  tamamlayan_id =?, musteri_id =? ,tamamlanacak_tarih=?, musteri_eleman_id=? ,musteri_adres=?,tel_no=?,aciklama=? WHERE id = ?"); 
    $data = $sorgu->execute([
        $_POST['tamamlayan_id'],
        $_POST['musteri_id'],
        $_POST['tamamlanacak_tarih'],
        $_POST['musteri_eleman_id'],
        $_POST['musteri_adres'],
        $_POST['tel_no'],
        $_POST['aciklama'],
        $_POST['id']
    ]);

    if ($sorgu->rowCount() > 0 ){  //rowCount methodu silinen kayıtların sayısını verirmiş
echo $sorgu->rowCount() . " KAYIT DÜZENLENDİ.";
    }else {
        echo "Herhangi bir kayıt düzenlenemedi.";
    }
}catch (PDOException $e) {
    die($e->getMessage());
}
}
$baglanti =null ;
?>
<meta http-equiv="refresh" content="0;URL=ziyaret.php">



<!-- <?php
//include "db.php";
//if ($_POST) {

//try {
  //  $sorgu = $db->prepare("UPDATE ziyaretler set  tamamlayan_id =?, musteri_id =? ,tamamlanan_tarih=?, musteri_eleman_id=? ,musteri_adres=?,tel_no=?,aciklama=? WHERE id = ?"); 
   // $data = $sorgu->execute([
       // $_POST['tamamlayan_id'],
      //  $_POST['musteri_id'],
     //   $_POST['tamamlanan_tarih'],
      //  $_POST['musteri_eleman_id'],
        //$_POST['musteri_adres'],
        //$_POST['tel_no'],
        //$_POST['aciklama'],
      //  $_POST['id']
    //]);

  //  if ($sorgu->rowCount() > 0 ){  //rowCount methodu silinen kayıtların sayısını verirmiş
//echo $sorgu->rowCount() . " KAYIT DÜZENLENDİ.";
   // }else {
    //    echo "Herhangi bir kayıt düzenlenemedi.";
  //  }
//}catch (PDOException $e) {
  //  die($e->getMessage());
//}
//}
//$baglanti =null ;
//?>
<meta http-equiv="refresh" content="0;URL=ziyaret.php"> -->