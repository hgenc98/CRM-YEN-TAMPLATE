
<?php
session_start();
include "../db.php";
var_dump($_POST);
$EKLE = $db->prepare("INSERT INTO musteriler SET baslik=?,musteri_adi=?,adres=?,telefon_no=?,firma_id=?");

    $EKLEYAZ = $EKLE->execute([$_POST['baslik'],$_POST['musteri_adi'],$_POST['adres'],$_POST['telefon_no'],$_SESSION['kullanici']['firma_id']]);

    if ($EKLE) {
        $_SESSION["updated"] = "1";
        echo   "başarıyla kaydettin ";
    } else {
        
    }

?>
<meta http-equiv="refresh" content="0;URL=musteriler.php">
