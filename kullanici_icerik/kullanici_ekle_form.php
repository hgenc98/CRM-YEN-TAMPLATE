<?php
include "../header.php";
include "../db.php";
include "../islem2.php";

$breadcrumbs = [["link" => "kullanici.php", "baslik" => "Kullanici"], ["link" => "kullanici_ekle_form.php", "baslik" => "Kullanici Ekle"]];
include "../breadcrumb.php"; ?>
<form class="form-signin" method="post" action="kullanici_ekle_post.php" enctype="multipart/form-data">
    <div style="text-align:-webkit-center">
        <div>
            <h1 style="color:brown" class="h3 mb-3 font-weight-normal">KULLANICI EKLEMEK İÇİN </h1>
            <p style="color:brown;text-align:center">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
        </div>
        <div style="border:outset;border-radius:20px;;background-image: radial-gradient(100% 100% at 100% 0px,
            white 0px, gray 100%) !important;text-align: -webkit-center;width:50%">
            <div class="container"style="width:50%">
                <div class="form-label-group mt-5 ml-5 mr-5" style="color:brown;">
                    KULLANICI ADI VE SOYADI *
                    <input type="text" class="form-control" name="kullanici_adi" placeholder="first_name" required="" autofocus="">
                </div>
                <div class="form-label-group ml-5 mr-5" style="color:brown;">
                    E POSTA *
                    <input type="email" class="form-control" name="e_posta" placeholder="e-mail" required="">
                </div>
                <div class="form-label-group ml-5 mr-5" style="color:brown;">
                    ŞİFRE *
                    <input type="pasword" class="form-control" name="sifre" placeholder="sifre" required="">
                </div>
                <div class="form-label-group ml-5 mr-5" style="color:brown;">
                    KULLANICI TELEFONU *
                    <input type="number" class="form-control" name="tel" placeholder="tel" required="">
                </div>
                <div style="color:brown;" class="ml-5 mr-5">
                    ROL SEÇİNİZ *
                    <select class="form-select form-control " name="role_id" aria-label="Default select example">
                        <option selected>ROL SEÇİNİZ</option>
                        <?php foreach ($db->query("SELECT * from roller") as $roller) { ?>

                            <option value="<?php echo $roller["id"] ?>">
                                <?= $roller["role_adi"] . " " ?></option>

                        <?php } ?>
                    </select>
                </div>
                <div class="mt-4 ml-5 mr-5" style="color:brown;">
                    ŞUBE SEÇİNİZ *
                    <select class="form-select" name="sube_id" aria-label="Default select example">
                        <option selected>ŞUBE SEÇİNİZ</option>
                        <?php foreach ($db->query("SELECT * from kullanici_subeler") as $subeler) { ?>

                            <option value="<?= $subeler["id"] ?>">
                                <?= $subeler["sube_adi"] . " " ?></option>

                        <?php } ?>
                    </select>
                </div>
                <div style="text-align: center;">
                    <button class="mb-4 mt-4 " type="submit" style="border:4px outset ; border-radius:10px;background-image: radial-gradient(100% 100% at 100% 0px,
            rgb(90, 218, 255) 0px, rgb(84, 104, 255) 100%) !important; width: 40%;">
                        EKLE
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="../dist/js/tabler.min.js"></script>
<script src="../dist/js/demo.min.js"></script>