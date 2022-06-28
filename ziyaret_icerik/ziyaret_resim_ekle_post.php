<?php
include "../db.php";



if ($_POST["resimler"]) {
    var_dump($_POST);
    $targerDir = "C:/wamp64/www/crm-yeni/img/";
    $filenames = array_filter($_FILES["resim"]["name"]);
    if (!empty($filenames)) {
        foreach ($_FILES['resim']['name'] as $name => $value) {
            $file_name = explode(".", $_FILES['resim']['name'][$name]);
            $new_name = md5(rand()) . '.' . $file_name[1];
            $sourcePath = $_FILES['resim']['tmp_name'][$name];
            $targetPath = $targerDir . $new_name;
           
            
            if (move_uploaded_file($_FILES["resim"]["tmp_name"][0], 'C:/wamp64/www/crm-yeni/img/' . $new_name)) {
                //$sql = $db->prepare('UPDATE ziyaretler SET aciklama =:notlar where id=:id');
                //$sql->execute(['notlar' => $_POST['notlar'], 'id' => $_POST['id']]);
                $sql = $db->prepare("INSERT INTO ziyaret_resim SET resim=:resim, ziyaret_id=:id ");
                $sql->execute([
                    "resim" => $new_name,
                    "id" => $_POST['id']
                ]);
                echo "başarılı";
            } else {
                echo "olmadı";
            }
        }
    } 
    if(isset($_POST['notlar']) && $_POST['notlar']!= "") {
        $EKLE = $db->prepare("INSERT INTO ziyaret_notu SET aciklama=?,kullanici_id=?,ziyaret_id=?");

        $EKLEYAZ = $EKLE->execute([$_POST['notlar'], $_POST['kullanici_id'], $_POST['ziyaret_id']]);

    }
} else if ($_POST) {
    $uzanti;
    $resimyolu = "";
    $dosya = $_FILES["resim"]["tmp_name"];
    if (!isset($_FILES["resim"]["name"])) {
        echo "lütfen bir resim seçiniz";
    } else {
        $tmp = explode('.', $_FILES["resim"]["name"]);
        $uzanti = end($tmp);
        // $uzanti = end(explode(".",$_FILES["resim"]["name"]));
        $resimAdi = md5(rand(100000, 999999));
        $name = $resimAdi . "." . $uzanti;
        $resimyolu = $resimAdi . "." . $uzanti;
        move_uploaded_file($_FILES["resim"]["tmp_name"], 'C:/wamp64/www/crm-yeni/img/' . $name);
    }
    $EKLE = $db->prepare("INSERT INTO ziyaret_resim SET tamamlayan_id=?,resim=?");

    $EKLEYAZ = $EKLE->execute([$_POST['tamamlayan_id'], $resimyolu]);

    if ($EKLE) {
        $_SESSION["updated"] = "1";
    } else {
    }
}  if ($_POST["resimler"]) {
    
}
var_dump($_POST["resimler"]);
?>
<meta http-equiv="refresh" content="0;URL=ziyaret_aciklama_detay.php?id=<?=$_POST["id"]?>">