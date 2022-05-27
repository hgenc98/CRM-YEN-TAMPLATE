<?php
include "../db.php";



try {
    $sorgu = $db->prepare("DELETE FROM musteri_eleman WHERE musteri_id=?");
    $sorgu->execute([$_GET['id']]);
    $sorgu2 = $db->prepare("DELETE FROM musteriler WHERE id=?");
    $sorgu2->execute([$_GET['id']]);
    $sorgu3 = $db->prepare("DELETE FROM ziyaretler WHERE id=?");
    $sorgu3->execute([$_GET['id']]);
 
   
    if ($sorgu) {  
        echo  " KAYIT SİLİNDİ.";
    } else {
        echo "Herhangi bir kayıt silinemedi.";
    }  if ($sorgu2) {  
        echo  " KAYIT SİLİNDİ.";
    } else {
        echo "Herhangi bir kayıt silinemedi.";
    } if ($sorgu3) {  
        echo  " KAYIT SİLİNDİ.";
    } else {
        echo "Herhangi bir kayıt silinemedi.";
    }
} catch (PDOException $e) {
    die($e->getMessage());
}

$baglanti = null;
?>
<meta http-equiv="refresh" content="0;URL=musteriler.php">