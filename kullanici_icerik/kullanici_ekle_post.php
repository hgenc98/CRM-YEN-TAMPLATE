
<?php
include "../db.php";
var_dump($_POST);
$EKLE = $db->prepare("INSERT INTO kullanicilar SET kullanici_adi=?,e_posta=?,sifre=?,role_id=?,sube_id=?,tel=?");

    $EKLEYAZ = $EKLE->execute([$_POST['kullanici_adi'], $_POST['e_posta'],$_POST['sifre'],$_POST['role_id'],$_POST['sube_id'],$_POST['tel']]);

    if ($EKLE) {
        $_SESSION["updated"] = "1";
        echo   "başarıyla kaydettin ";
    } else {
        
    }

?>
<meta http-equiv="refresh" content="0;URL=kullanici.php">
