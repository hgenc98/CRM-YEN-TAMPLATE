<?php
include "../db.php";
if ($_POST) {

    try {
        $sorgu = $db->prepare("UPDATE musteriler set  musteri_adi =?, adres =?  ,telefon_no=? WHERE id = ?");

        $sorgu->execute([$_POST['musteri_adi'], $_POST['aciklama'], $_POST['telefon_no'], $_POST['id']]);

        $sorgu = $db->prepare("UPDATE musteri_eleman set  eleman_adi=? WHERE musteri_id = ?");

        $sorgu->execute([$_POST['eleman_adi'], $_POST['id']]);
        if ($sorgu->rowCount() > 0) {  //rowCount methodu silinen kayıtların sayısını verirmiş
            echo $sorgu->rowCount() . " KAYIT DÜZENLENDİ.";
        } else {
            echo "Herhangi bir kayıt düzenlenemedi.";
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


$baglanti = null;
?>
<meta http-equiv="refresh" content="0;URL=musteriler.php">