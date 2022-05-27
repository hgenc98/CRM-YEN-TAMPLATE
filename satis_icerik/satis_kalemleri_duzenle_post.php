<?php
include "../db.php";
if ($_POST) {

try {   
    $sorgu = $db->prepare("UPDATE satis_kalemleri set  urun_adi=?,adet=?,birim_fiyati=? WHERE id = ?");
 
    $rowCount = $sorgu->execute([$_POST['urun_adi'],$_POST['adet'],$_POST['birim_fiyati'],$_POST['id']]);
    //echo $rowCount;
    if ($sorgu->rowCount() > 0){  //rowCount methodu silinen kayıtların sayısını verirmiş
        echo $sorgu->rowCount() . " KAYIT DÜZENLENDİ.";
    }else {
        echo "Herhangi bir kayıt düzenlenemedi.";
    }
    var_dump($_POST);
}catch (PDOException $e) {
    die($e->getMessage());
}
}
$baglanti =null ;
?>
<meta http-equiv="refresh" content="0;URL=satis_kalemleri.php">