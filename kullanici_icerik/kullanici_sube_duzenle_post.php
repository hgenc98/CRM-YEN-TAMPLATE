<?php
include "../db.php";
if ($_POST) {

try {
    $sorgu = $db->prepare("UPDATE kullanici_subeler set  sube_adi =?,yetkili_adi=?,yetkili_telefon=?,e_posta =? WHERE id = ?");
 //  kullanici_adi=?,e_posta=?,role_id=?,sube_id=?,tel=?"
 
    $sorgu->execute([$_POST['sube_adi'],$_POST['yetkili_adi'],$_POST['yetkili_telefon'],$_POST['e_posta'],$_POST['id']]);
    
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
<meta http-equiv="refresh" content="0;URL=kullanici_subeler.php">