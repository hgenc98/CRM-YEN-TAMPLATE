<?php
include("ayar.php");
session_start();
ob_start();
session_destroy();
echo "Çıkış Yaptınız.Ana Sayfaya Yönlendiriliyorsunuz";
header("Refresh: 1; url=giris.php");
//Şimdi logout.php sayfasıyla session kaydını silip siteden çıkış yapacağız.Bunun için session_destroy(); fonksiyonunu kullanacağız. -->

?>