<?php
include "../db.php";
session_start();


var_dump($_POST);
$urun_adi = $_POST ["urun_adi"];
$adet = $_POST["urun_adedi"];
$fiyat = $_POST["birim_fiyat"];

$EKLE = $db->prepare("INSERT INTO satislar SET sirket_adi=?, musteri_id=?,kullanici_id=?,satis_tarihi=?,satis_not=?,firma_id=?");

$EKLEYAZ = $EKLE->execute([$_POST['sirket_adi'] ,$_POST['musteri_id'], $_POST['kullanici_id'], $_POST['satis_tarihi'], $_POST['satis_not'],$_SESSION['kullanici']['firma_id']]);
$satis_id = $db->lastInsertId();
if ($EKLE) {
    $_SESSION["updated"] = "1";
    echo   "başarıyla kaydettin ";
} else {
}
$bos = [];
for ($i = 0; $i < count ($fiyat); $i++) {
    array_push(
        $bos,
        array(
            $urun_adi[$i], $adet[$i], $fiyat[$i]
        )
    );
}

print_r($bos);
foreach ($bos as $value) {
    $EKLE = $db->prepare("INSERT INTO satis_kalemleri SET satis_id=?,urun_adi=?,adet=?,birim_fiyati=?");

    $EKLEYAZ = $EKLE->execute([$satis_id, $value[0], $value[1], $value[2]]);

    if ($EKLE) {
        $_SESSION["updated"] = "1";
        echo   "başarıyla kaydettin ";
    } else {
    }
}

?>
<link rel="stylesheet" href="../satis_icerik/satis.js">
<meta http-equiv="refresh" content="0;URL=satislar.php">