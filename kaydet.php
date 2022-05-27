
<?php
include "db.php";

$sql = $db->prepare("INSERT INTO kullanici_girisi SET e_mail=?,sifre=?");
    $sql = $sql->execute([$_POST['e_mail'], $_POST['sifre']]);

    if ($sql) {
        $_SESSION["updated"] = "1";
        echo   "başarıyla kaydettin ";
    } else {
        
    }


?>
<meta http-equiv="refresh" content="0;URL=anasayfa.php">
