<?php
// ayar.php dosyamızı include ediyoruz ve session_start(); fonksiyonumuzu çalıştırıyoruz.
include("ayar.php");
session_start();
ob_start();
include "db.php";

$sql=$db->prepare("SELECT * from kullanicilar where e_posta=? and sifre=? ");
$EKLEYAZ = $sql->execute([$_POST['e_mail'], $_POST['sifre']]);

$kullanici =$sql->fetchAll();


if(count($kullanici) > 0){
$_SESSION["login"] = true;
$_SESSION["adi"] = $kullanici[0]['kullanici_adi'];
$_SESSION["rol"] = $kullanici[0]['role_id'];
$_SESSION["kullanici_id"] = $kullanici[0]['id'];
$_SESSION["firma_id"] = $kullanici[0]['firma_id'];
$_SESSION["sozlesme_bitis"] = $kullanici[0]['sozlesme_bitis'];
 header("Location:anasayfa.php");
}elseif(count($kullanici) == 0){    
    echo "Sözleşme süreniz bitmiştir.Lütfen Bizimle iletişime geçin";
    header("Refresh: 2; url=giris.php");
}else{
    echo "Kullanıcı adı veya Şifre Yanlış.";
    header("Refresh: 2; url=giris.php");
}




//formdan gelen bilgileri çekip ayar.php dosyamızdaki bilgilerle doğru olup olmadığını kontrol ediyoruz.
if(($_POST["e_mail"]==$user) and ($_POST["sifre"]==$pass)){
//eğer bilgiler doğruysa login ismi verdiğimiz session kaydını yapıyoruz.ve session kaydını kullanıcı adıyla şifremize eşitliyoruz.
$_SESSION["login"] = "true";
$_SESSION["user"] = $user;
$_SESSION["pass"] = $pass;
//header("Location:anasayfa.php");
}else{
//diğer durumda hata mesajı verip giriş sayfamıza yönlendiriyoruz.
//echo "Kullanıcı adı veya Şifre Yanlış.";
//header("Refresh: 2; url=giris.php");
}
ob_end_flush();
