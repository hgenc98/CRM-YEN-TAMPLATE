<?php

require 'vendor/autoload.php';
use Carbon\Carbon;

include "db.php";

if(isset($_POST['onay'])) { // checkbox seçilmişse "on" değeri gönderiliyor
    echo '';
} else { // seçilmemişse bu değer sayfaya hiç gönderilmiyor
    echo '';
}

$EKLE1 = $db->prepare("INSERT INTO firma SET firma_adi=?,sozlesme_baslangic=?, sozlesme_bitis=?");

$EKLEYAZ1 = $EKLE1->execute([$_POST['firma_adi'], Carbon::now(), Carbon::now()->addDay(30)]);
$EKLE1->id=$db->lastInsertId();
 
$EKLE = $db->prepare("INSERT INTO kullanicilar SET kullanici_adi=?,e_posta=?,sifre=?,tel=?,firma_id=?");

$EKLEYAZ = $EKLE->execute([$_POST['kullanici_adi'], $_POST['e_posta'], $_POST['sifre'], $_POST['tel'],$EKLE1->id]);

die;
if ($EKLE) {
    $_SESSION["updated"] = "1";
    echo   "başarıyla kaydettin ";
} else {
}

?>
<meta http-equiv="refresh" content="0;URL=giris.php">