<?php 
include '../db.php';

if(isset($_POST['selected2'])){
    $selected2= $_POST['selected2'];
    $musteri_eleman = $db->query("SELECT * FROM musteriler where id=".$selected2)->fetchAll();

echo json_encode($musteri_eleman);    
}else{
    if(isset($_POST['selected'])){
        $selected= $_POST['selected'];

        
        $musteri_eleman = $db->query("SELECT * FROM musteri_eleman where musteri_id=".$selected)->fetchAll();
        $musteri = $db->prepare("SELECT * FROM musteriler where id=:id");
        $musteri->execute(['id' => $musteri_eleman[0]['musteri_id']]);
        $musteri = $musteri->fetch();
        $data=[$musteri_eleman, $musteri];
        
        
        echo json_encode($data);
    }
}


?>