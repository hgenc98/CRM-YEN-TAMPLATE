<?php
include "../header.php";
include "../db.php";
include "../islem2.php";
?>
<div class="page container">
    <?php
    $breadcrumbs = [["link" => "kullanici.php", "baslik" => "Kullanici"], ["link" => "kullanici_ekle_form.php", "baslik" => "Kullanici Ekle"]];
    include "../breadcrumb.php"; ?>
    <form class="form-signin page" method="post" action="kullanici_ekle_post.php" enctype="multipart/form-data">
        <div style="text-align:-webkit-center">
            <div class="container w-50 col-12 " style="background-color:white;border: 1px solid var(--tblr-border-color);
                              border-radius: 4px;">
                <div class="row">
            <div>
                <h1 style="color:brown" class="h3 mb-3 mt-3 font-weight-normal">KULLANICI EKLEMEK İÇİN </h1>
                <p style="color:brown;text-align:center">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
            </div>

                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        KULLANICI ADI VE SOYADI *
                        <input type="text" class="form-control mt-3" name="kullanici_adi" placeholder="first_name" required="" autofocus="">
                    </div>
                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        E POSTA *
                        <input type="email" class="form-control  mt-3" name="e_posta" placeholder="e-mail" required="">
                    </div>
                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        ŞİFRE *
                        <input type="pasword" class="form-control  mt-3" name="sifre" placeholder="sifre" required="">
                    </div>
                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        KULLANICI TELEFONU *
                        <input type="number" class="form-control  mt-3" name="tel" placeholder="tel" required="">
                    </div>
                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        ROL SEÇİNİZ *
                        <select class="form-select form-control  mt-3" name="role_id" aria-label="Default select example">
                            <option selected>ROL SEÇİNİZ</option>
                            <?php foreach ($db->query("SELECT * from roller") as $roller) { ?>

                                <option value="<?php echo $roller["id"] ?>">
                                    <?= $roller["role_adi"] . " " ?></option>

                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-label-group mb-3 text-start mt-3 col-6">
                        ŞUBE SEÇİNİZ *
                        <select class="form-select  mt-3" name="sube_id" aria-label="Default select example">
                            <option selected>ŞUBE SEÇİNİZ</option>
                            <?php foreach ($db->query("SELECT * from kullanici_subeler") as $subeler) { ?>

                                <option value="<?= $subeler["id"] ?>">
                                    <?= $subeler["sube_adi"] . " " ?></option>

                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary mb-3">EKLE</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>