<?php
include "../db.php";
if ($_POST) {

try {
    $sorgu = $db->prepare("UPDATE kullanicilar set  kullanici_adi =?, e_posta =?  ,sube_id=?,tel=?,sifre=? WHERE id = ?");

    $sorgu->execute([$_POST['kullanici_adi'],$_POST['e_posta'],$_POST['sube_id'],$_POST['tel'],$_POST['sifre'],$_POST['id']]);
    
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
<meta http-equiv="refresh" content="0;URL=anasayfa.php">