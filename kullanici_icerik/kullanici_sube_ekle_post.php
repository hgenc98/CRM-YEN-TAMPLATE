
<?php
include "../db.php";
var_dump($_POST);
$EKLE = $db->prepare("INSERT INTO kullanici_subeler SET sube_adi=?,yetkili_adi=?,yetkili_telefon=?,e_posta=?");

    $EKLEYAZ = $EKLE->execute([$_POST['sube_adi'], $_POST['yetkili_adi'],$_POST['yetkili_telefon'],$_POST['e_posta']]);

    if ($EKLE) {
        $_SESSION["updated"] = "1";
        echo   "başarıyla kaydettin ";
    } else {
        
    }

?>
<meta http-equiv="refresh" content="0;URL=kullanici_subeler.php">
