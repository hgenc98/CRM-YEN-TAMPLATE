
<?php
include "../db.php";
session_start();
var_dump($_POST);
$EKLE = $db->prepare("INSERT INTO musteri_eleman SET eleman_adi=?,telefon_no=?,e_posta=?,musteri_id=? ,unvan=?,firma_id=?");

    $EKLEYAZ = $EKLE->execute([$_POST['eleman_adi'], $_POST['telefon_no'],$_POST['e_posta'],$_POST['musteri_id'],$_POST['unvan'],$_SESSION['kullanici']['firma_id']]);

    if ($EKLE) {
        $_SESSION["updated"] = "1";
        echo   "başarıyla kaydettin ";
    } else {
        
    }

?>
<meta http-equiv="refresh" content="0;URL=musteri_eleman.php">
