<?php
include "../db.php";
if ($_POST) {

try {
    $sorgu = $db->prepare("UPDATE satislar set  musteri_id =?, kullanici_id =? , satis_tarihi=? WHERE id = ?");
    
    $sorgu->execute([$_POST['musteri_id'],$_POST['kullanici_id'],$_POST['satis_tarihi'],$_POST['id']]);
    
    

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
<meta http-equiv="refresh" content="0;URL=satislar.php">