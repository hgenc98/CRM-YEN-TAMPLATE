<?php
include "../db.php";



try {
    $sorgu = $db->prepare("DELETE FROM kullanicilar WHERE id=?");
    $sorgu->execute([$_GET['id']]);
    $sorgu = $db->prepare("DELETE FROM roller WHERE role_adi=?");
    $sorgu->execute([$_GET['id']]);
    $sorgu = $db->prepare("DELETE FROM kullanici_subeler WHERE sube_adi=?");
    $sorgu->execute([$_GET['id']]);
   
    if ($sorgu->rowCount() > 0) {  //rowCount methodu silinen kayıtların sayısını verirmiş
        echo $sorgu->rowCount() . " KAYIT SİLİNDİ.";
    } else {
        echo "Herhangi bir kayıt silinemedi.";
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
$baglanti = null;
?>
<meta http-equiv="refresh" content="0;URL=kullanici.php">