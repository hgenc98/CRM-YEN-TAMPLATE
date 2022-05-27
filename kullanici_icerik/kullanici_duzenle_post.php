<?php
include "../db.php";
if ($_POST) {

try {
    $sorgu = $db->prepare("UPDATE kullanicilar set  kullanici_adi =?, e_posta =? , role_id=? ,sube_id=?,tel=? WHERE id = ?");
 //  kullanici_adi=?,e_posta=?,role_id=?,sube_id=?,tel=?"
 
    $sorgu->execute([$_POST['kullanici_adi'],$_POST['e_posta'],$_POST['role_id'],$_POST['sube_id'],$_POST['tel'],$_POST['id']]);
    
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
<meta http-equiv="refresh" content="0;URL=kullanici.php">