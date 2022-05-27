<?php
include "../db.php";
if ($_POST) {

try {
    $sorgu = $db->prepare("UPDATE musteri_eleman set  eleman_adi =?, telefon_no =? , e_posta=? ,musteri_id=?,unvan=? WHERE id = ?");
 
 
    $sorgu->execute([$_POST['eleman_adi'],$_POST['telefon_no'],$_POST['e_posta'],$_POST['musteri_id'],$_POST['unvan'],$_POST['id']]);
    
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
<meta http-equiv="refresh" content="0;URL=musteri_eleman.php">