<?php
include "db.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap.js">
    <link rel="stylesheet" href="floating-labels.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <link rel="stylesheet" href="lightbox.css">
    <link rel="stylesheet" href="ust.css">
    <title>CRM</title>

    <script src="https://kit.fontawesome.com/2e649c532e.js" crossorigin="anonymous"></script>

</head>

<body>
    <h4 class="mt-5">HOŞ GELDİNİZ , LÜTFEN AŞŞAĞIDAKİ BİLGİLERİ EKSİKSİZ DOLDURALIM !!</h4>

    <div class="container mt-5 d-flex justify-content-center " style="text-align:-webkit-center">
        <div style="border: outset 1px black;width: 500px;border-radius: 60px;" class="bg-muted">
            <div class="kutu4 d-flex justify-content-center align-items-center flex-column mt-3">
                <div class=" mt-3 d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-user"></i><!-- burası tekrardan ayarlanacak -->
                </div>
                <i>
                    <h3 class="mt-2">KAYIT OL</h3>
                </i>
            </div>
            <hr>
            <form method="POST" action="kayit.php" class="position: relative margin:auto" style="text-align: center;">
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <div class="form-group col" style="text-align: -webkit-center">
                        <i><strong><label class="mt-4 mb-4" for="text">Adınız Soyadınız :</label></strong></i>
                        <input type="text" style="width: auto;text-align:center" class="form-control mb-4" id="text" name="kullanici_adi" placeholder="Adınız">

                    </div>
                    <div class="form-group col" style="text-align: -webkit-center">
                        <i><strong><label class="mt-4 mb-4" for="text">Firma Adı :</label></strong></i>
                        <input type="text" style="width: auto;text-align:center" class="form-control mb-4" id="text" name="firma_adi" placeholder="Firma Adınız">

                    </div>
                    <div class="form-group col" style="text-align: -webkit-center">
                        <i><strong><label class="mt-4 mb-4" for="exampleInputEmail1">Email address :</label></strong></i>
                        <input type="e_mail" style="width: auto;text-align:center" class="form-control mb-4" id="exampleInputEmail1" name="e_posta" placeholder="Mail Adresiniz">

                    </div>
                    <div class="form-group col" style="text-align: -webkit-center">
                        <i><strong><label class="mb-4" for="exampleInputPassword1">Şifre :</label></strong></i>
                        <input type="password" style="width: auto;text-align:center" class="form-control mb-4" id="exampleInputPassword1" name="sifre" placeholder="Sifreniz">
                    </div>
                    <div class="form-group col" style="text-align: -webkit-center">
                        <i><strong><label class="mt-4 mb-4" for="exampleInputEmail1">Telefon NO:</label></strong></i>
                        <input type="text" style="width: auto;text-align:center" class="form-control mb-4" id="text" name="tel" placeholder="Telefon Numaranız">

                    </div>
                    <form action="ziyaret_icerik/ziyaret_resim_ekle_post.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="form-label-group">
                                <p style="color:white">ZİYARET YERİ *</p>
                                <input type="text" class="form-control col-5" name="tamamlayan_id" placeholder="" required="" autofocus="">
                            </div>
                            <label for="exampleFormControlFile1">RESSİM EKLE</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="resim">
                        </div>
                        <div> <input type="submit" value="gönder"></div>
                    </form>
                    <form action="kayit.php" method="post">
                        <div class="card mb-3">
                            <div class="container">
                                <h5 class="card-header">Sözleşme</h5>
                                <div class="card-body">
                                    <h5 class="card-title" style="color:red">Sözleşmemiz Minimum 6 Ay'dır </h5>
                                    <p class="card-text">İlk Ay Ücretsiz Deneme Sürecidir , İkinci Aydan İtibaren Ücretlendirme İçin Yöneticimizle İletişime Geçin , Aksi Takdirde Sistemden Yönetici Tarafından Silineceksiniz </p>
                                    <label> <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        <a href=""> Onaylıyorum</a></label>
                                </div>
                            </div>


                    </form>
                    <small id="emailHelp" class="form-text text-muted mb-4">E-postanızı asla başkalarıyla paylaşmayacağız.</small>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" style="color:white !important"> GİRİŞ YAP</button>
                </div>
            </form>
        </div>
    </div>

</body>