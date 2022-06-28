<?php
include "db.php";


if ($_GET) {
    $SELECT = $db->prepare("SELECT * FROM kullanici_giris WHERE id=?");

    $SELECT->execute([$_GET['id']]);
    $selected_user = $SELECT->fetch();
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap.js">
    <link rel="stylesheet" href="giris.js">
    <link rel="stylesheet" href="giris.css">
    <link rel="stylesheet" href="floating-labels.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <link rel="stylesheet" href="lightbox.css">
    <link rel="stylesheet" href="ust.css">
    <title>CRM</title>

    <script src="https://kit.fontawesome.com/2e649c532e.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="giris.js"></script>
</head>

<body>
    <div class="panel shadow1">
        <div class="panel-switch animated fadeIn">
            <button type="button" id="sign_up" class="active-button" style="margin-top:35px">Kaydol</button>
            <button type="button" id="log_in" class="" disabled>Giriş Yap</button>
        </div>
        <div class="login-form">

            <form id="login-fieldset" method="POST" action="login.php" class="" style="position: relative; margin:auto">
                <h1 class="animated fadeInUp animate1" id="title-login"> HOŞ GELDİNİZ !</h1>
                <h1 class="animated fadeInUp animate1 hidden" id="title-signup">HOŞGELDİNİZ !</h1>
                <fieldset>
                    <p style="color:white">Kullanıcı Girisi :</p>
                    <input class="login animated fadeInUp animate2" name="e_mail" type="textbox" required placeholder="Kullanıcı adı ( deneme@deneme.com )" value="">
                    <p style="color:white">Şifreniz :</p>
                    <input class="login animated fadeInUp animate3" name="sifre" type="password" required placeholder="sifre" value="">
                    <input type="submit" id="login-form-submit" class="login_form button animated fadeInUp animate4" value="Giris Yap">
                </fieldset>
            </form>
            <form id="signup-fieldset" method="POST" action="kayit.php" class="hidden" style="position: relative; margin:auto;padding-top: 0;" enctype="multipart/form-data">
                <h1 class="animated fadeInUp animate1" id="title-login">ARAMIZA KATILMAK İSTER MİSİNİZ? !</h1>
                <h1 class="animated fadeInUp animate1 hidden" id="title-signup">HOŞGELDİNİZ ARAMIZA !</h1>
                <fieldset>
                    <p style="color:white">Adınız Soyadınız :</p>
                    <input class="login animated fadeInUp animate2" name="kullanici_adi" type="textbox" required placeholder="adınız soyadınız " value="">
                    <p style="color:white">Firma Adı :</p>
                    <input class="login animated fadeInUp animate2" name="firma_adi" type="textbox" required placeholder="firma adı" value="">
                    <p style="color:white">Email address :</p>
                    <input class="login animated fadeInUp animate2" name="e_posta" type="e-mail" required placeholder="e-mail" value="">
                    <p style="color:white">ŞİFRE:</p>
                    <input class="login animated fadeInUp animate3" name="sifre" type="password" placeholder="sifre" required value="">
                    <p style="color:white">TELEFON NUMARASI:</p>
                    <input class="login animated fadeInUp animate2" name="tel" type="textbox" required placeholder="tel" value="">
                    <p style="color:white">FİRMA LOGO :</p>
                    <input class="login animated fadeInUp animate2" name="resim" type="file" required placeholder="resimler" value="">
                    
                    <input type="submit" id="signup-form-submit" class="login_form button animated fadeInUp animate4 hidden" value="Kaydol">
                    <p><a id="lost-password-link" href="" class="animated fadeIn animate5">SÖZLEŞME</a></p>
                </fieldset>
            </form>
        </div>
    </div>

    <script src="giris.js"></script>
</body>

</html>