<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

include "db.php";



 
if (isset($_POST['onay'])) { // checkbox seçilmişse "on" değeri gönderiliyor
    echo '';
} else { // seçilmemişse bu değer sayfaya hiç gönderilmiyor
    echo '';
}
var_dump($_FILES);
if ($_FILES["resim"]) {
    var_dump($_POST);
    $targerDir = "C:/wamp64/www/tabler/img/";
    $x = [$_FILES['resim']['name']];
    foreach ($x as $name => $value) {
        $file_name = explode(".", $_FILES['resim']['name'][$name]);
        $new_name = md5(rand()) . '.' . $file_name[0];
        $sourcePath = $_FILES['resim']['tmp_name'][$name];
        $targetPath = $targerDir . $new_name;
       
        $sql = $db->prepare("INSERT INTO firma SET firma_adi=?,sozlesme_baslangic=?, sozlesme_bitis=?,firma_logo=?");
        $sql->execute([
            $_POST['firma_adi'],
            Carbon::now(),
            Carbon::now()->addDay(30),
             $new_name,  
        ] );
       

    
        
       
        $EKLE = $db->prepare("INSERT INTO kullanicilar SET kullanici_adi=?,e_posta=?,sifre=?,tel=?,firma_id=?");
       
        $EKLE->id=$db->lastInsertId();
        $EKLEYAZ = $EKLE->execute([$_POST['kullanici_adi'], $_POST['e_posta'], $_POST['sifre'], $_POST['tel'],$EKLE->id]);

        if (move_uploaded_file($_FILES["resim"]["tmp_name"][$name], 'C:/wamp64/www/tabler/img/' . $new_name)) {
            //$sql = $db->prepare('UPDATE ziyaretler SET aciklama =:notlar where id=:id');
            //$sql->execute(['notlar' => $_POST['notlar'], 'id' => $_POST['id']]);

            echo "olmadı";
        } else {
            echo "başarılı";
        }
    }
}
// die;
// if ($EKLE) {
//     $_SESSION["updated"] = "1";
//     echo   "başarıyla kaydettin ";
// } else {
// }



// $sql = $db->prepare("INSERT INTO  SET ziyaret_id=?,resim=? ");

// $sql=$db->prepare('INSERT INTO ziyaret_resim SET ziyaret_id=?,resim=?');
// $EKLEYAZ = $sql->execute([$_POST['ziyaret_id'],$_POST['resim']]);

 ?>
<meta http-equiv="refresh" content="0;URL=giris.php">
