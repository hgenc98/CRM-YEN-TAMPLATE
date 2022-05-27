<?php
include "../db.php";
if ($_POST) {

try {
    $sorgu = $db->prepare("UPDATE ziyaret_notu set aciklama=? WHERE id = ?");
 
    $sorgu->execute([$_POST['aciklama'],$_POST['id']]);

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