<?php
include "../db.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/Exception.php';
require '../src/PHPMailer.php';
require '../src/SMTP.php';

var_dump($_POST);

$EKLE = $db->prepare("INSERT INTO ziyaretler SET tamamlayan_id=?,musteri_id=?,musteri_eleman_id=?,tel_no=?,musteri_adres=?,tamamlanacak_tarih=?,aciklama=?,firma_id=?,durum=0");

$EKLEYAZ = $EKLE->execute([
    $_POST['tamamlayan_id'], $_POST['musteri_adi'], $_POST['musteri_eleman_id'], $_POST['tel_no'],
    $_POST['musteri_adres'], $_POST['tamamlanacak_tarih'], $_POST['aciklama'],$_SESSION['kullanici']['firma_id']
]);
$EKLE2 = $db->prepare("SELECT * FROM kullanicilar where id=:id");
$EKLEYAZ = $EKLE2->execute([
   'id' => $_POST['tamamlayan_id']]);
   $EKLE2 =  $EKLE2 ->fetch();
if ($EKLE) {
    $_SESSION["updated"] = "1";

    $mail = new PHPMailer(true);
    try {
        
$mail->CharSet = 'UTF-8';

$mail->Encoding = 'base64';

$mail->isSMTP();

$mail->Username   = 'genc3898@gmail.com';
$mail->Password   = 'swausxtrbfrzowpu';

$mail->Host = 'smtp.googlemail.com';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->SMTPOptions = array (
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true)
);

$mail->setFrom('genc3898@gmail.com');
    $mail->addAddress($EKLE2["e_posta"]);

$mail->isHTML(true);
$mail->Subject = 'İletişim Formu.';
        $mail->Body = $_POST['tamamlanacak_tarih'] . " bu tarihte " .  $_SESSION['kullanici']["kullanici_adi"] . " (Admin) tarafından size ziyaret düzenlenmiştir. lütfen alanınızı kontrol ediniz !!!" ;
        $mail->Body .= "
        <html> 
        <a type='button' class='btn btn-primary' href ='http://localhost/crm-yeni/giris.php'>SAYFAYA GİT</a>
        </html>
        ";
$mail->send();

        echo "Mesajınız İletildi --> "  . "<br>";
    } catch (Exception $e) {
        echo 'Mesajınız İletilemedi. Hata: ', $mail->ErrorInfo;
    }
} else {
}

?>
<meta http-equiv="refresh" content="0;URL=ziyaret.php?ziyaret">