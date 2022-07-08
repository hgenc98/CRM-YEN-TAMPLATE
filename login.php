<?php
// ayar.php dosyamızı include ediyoruz ve session_start(); fonksiyonumuzu çalıştırıyoruz.
include("ayar.php");
session_start();
ob_start();
include "db.php";

$sql = $db->prepare("SELECT kullanicilar.*, firma.firma_logo from kullanicilar 
LEFT JOIN firma on firma.id=kullanicilar.firma_id
where kullanicilar.e_posta=? and kullanicilar.sifre=?
");
$EKLEYAZ = $sql->execute([$_POST['e_mail'], $_POST['sifre']]);

$kullanici = $sql->fetch();


if ($kullanici) {
    $_SESSION["login"] = true;
    $_SESSION["kullanici"] = $kullanici;


   
} elseif (!$kullanici) {
    echo "Kullanıcı adı veya Şifre Yanlış.  Veya ";
    echo " Sözleşme süreniz bitmiştir.Lütfen Bizimle iletişime geçin";
    header("Refresh: 2; url=giris.php");
} else {
    echo "Giriş Yaptınız Tebrikler ...";
    header("Refresh:2; url=anasayfa.php");
}
//  header("Location:anasayfa.php");


 //formdan gelen bilgileri çekip ayar.php dosyamızdaki bilgilerle doğru olup olmadığını kontrol ediyoruz.
 if ($kullanici) {
    //eğer bilgiler doğruysa login ismi verdiğimiz session kaydını yapıyoruz.ve session kaydını kullanıcı adıyla şifremize eşitliyoruz.
    $_SESSION["login"] = "true";
    $_SESSION["user"] = $user;
    $_SESSION["pass"] = $pass;
    header("Location:anasayfa.php");
} else {
    //diğer durumda hata mesajı verip giriş sayfamıza yönlendiriyoruz.
    echo "Kullanıcı adı veya Şifre Yanlış.";
    header("Refresh: 2; url=giris.php");
}
ob_end_flush();