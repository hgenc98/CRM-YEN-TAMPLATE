<?php
include "../header.php";
include "../db.php";
include "../islem2.php";




$sql = $db->query('SELECT * FROM ziyaret_resim WHERE ziyaret_id= ' . $_GET["id"])->fetchAll();
$ziyaret = $db->prepare('SELECT ziyaretler.*, musteriler.baslik, musteriler.id as musteri_id FROM ziyaretler
LEFT JOIN musteriler  on musteriler.id = ziyaretler.musteri_id
 WHERE ziyaretler.id=:id');
$ziyaret->execute([
    'id' => $_GET['id'],
]);
$ziyaret = $ziyaret->fetchAll();

$z_not = $db->prepare("SELECT * FROM ziyaret_notu where ziyaret_id =:id");
$z_not->execute([
    'id' => $ziyaret[0]['id'],
]);
$z_not = $z_not->fetchAll();

?>
<div class="container page">
    <?php
    $breadcrumbs = [["link" => "ziyaret.php", "baslik" => "Ziyaret"], ["link" => "ziyaret_aciklama_detay.php?id=" . $_GET["id"], "baslik" => "Ziyaret Aciklama Detay"]];
    include "../breadcrumb.php"; ?>

    <div class="col-md-12 container" style="border:solid;border-radius:20px;text-align: -webkit-center;background-color:white">
        <form action="ziyaret_resim_ekle_post.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
            <div class=" mt-5" style="text-align:center">

                <div style="text-align:-webkit-center;" class="mt-3">
                    <div class="col-6 ">
                        <h2 class=" " style="color:red">ZİYARET DETAY BİLGİLERİ</h2>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-5 mr-5">
                        <h2 style="color:red">RESİM EKLE</h2>
                        <hr>
                        <div class="form-group" style="color: black;">
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="resim[]" multiple="multiple" style="text-align-last: center;">
                            <input type="submit" name="resimler" value="Ekle" style="background:darkturquoise ; border-radius:25px; width:130px" class="mt-4">
                        </div>

                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <div class=" " style=" width:80%;text-align:-webkit-center">
                            <h2>
                                <p style="color: red;">DURUM </p>
                                <hr>
                                <?php
                                echo ($ziyaret[0]["durum"] == 1 ? "TAMAMLANDI" : "TAMAMLANMADI");
                                ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class=" mt-5" style="text-align:center">

                    <div class="row">
                        <div class="col-md-6">
                            <!-- <form action="ziyaret_notu_ekle.php" method="POST"> -->
                            <div style="text-align-last: center;" class="ml-5">
                                <h3 style="color: red;"> ALINACAK NOTLAR : *</h3>
                                <textarea name="notlar" id="editor1" class="ck_editor " style="width: 480px;"></textarea>
                                <!-- <input type="submit" value="gönder" name="aciklama"> -->
                            </div>
                            <!-- </form> -->
                        </div>

                        <div class="col-md-6">
                            <div class="  ml-5 bg-light" style="margin-right: 75px; width:100%">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead style="color:black">
                                        <tr>
                                            <th>ZİYARET EDİLEN ŞİRKET</th>
                                            <th>TAMAMLANACAK TARİH</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $ziyaret[0]['baslik'] ?></td>
                                            <td style="color:black"><?php echo (new DateTime($ziyaret[0]['tamamlanacak_tarih']))->format("d/m/y h:i:s") ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
                <input type="hidden" name="kullanici_id" value="<?php echo $ziyaret[0]["tamamlayan_id"] ?>">
                <input type="hidden" name="ziyaret_id" value="<?php echo $ziyaret[0]["id"] ?>">
                <div class="col-6 mt-3 ">
                    <input type="submit" name="resimler" value="gönder" style="background:darkturquoise ; border-radius:25px; width:130px">
                </div>
                <hr>
                <div class="col-12">
                    <div style="color:black ;overflow-x:auto;text-align:-webkit-center" class="mt-5 mb-5 bg-light">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead style="color:black">
                                <tr style="color:black">
                                    <th>ZİYARET NOTU</th>
                                    <th>NOTUN EKLENDİĞİ TARİH</th>
                                    <th>DÜZENLE</th>
                                    <?php
                                    $rol = $_SESSION['rol'];
                                    if ($rol == 1) { ?>
                                        <th class="card-header " scope="col">SİL</th>
                                    <?php } ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($z_not as $not) { ?>
                                    <tr>
                                        <td><?php echo $not['aciklama'] ?></td>
                                        <td><?php echo (new DateTime($not['eklenen_tarih']))->format("d/m/y h:i:s A") ?></td>
                                        <td><a href="ziyaret_notu_duzenle_form.php?id=<?php echo $not["id"] ?>"><svg style="color:white" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <desc>Download more icon variants from https://tabler-icons.io/i/file-pencil</desc>
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                    <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
                                                </svg></a></td>
                                        <?php
                                        $rol = $_SESSION['rol'];
                                        if ($rol == 1) { ?>
                                            <td style="color:black" class="card-header"><a href="ziyaret_not_sil.php?id=<?php echo $not["id"] ?>&ziyaretId=<?= $_GET["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <desc>Download more icon variants from https://tabler-icons.io/i/trash</desc>
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <line x1="4" y1="7" x2="20" y2="7"></line>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg></a></td>
                                        <?php } ?>
                                    </tr>
                                <?php }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-5 bg-primary" style="text-align: -webkit-center; border-radius: 20px;" >
        <h1 class="bg-dark" style="color:white; border:solid;border-radius:20px;background-color:white;width:36%">FOTOGRAFLAR</h1>
    </div>
    <div class="container mt-4">
        <div class="mt-1 row"  style="border:solid;border-radius:20px;text-align: -webkit-center;background-color:white">
            <?php
            foreach ($sql as $item) {
            ?>
                <div class="col-4 mt-3 mb-5">
                    <img src="<?php echo "../img/" . $item['resim'] ?>" alt="Resim bulunamadı" style="width: 80% ;max-height:350px;height:auto">
                    <br>
                    <button type="button" class="btn btn-info mt-3 "><a class="mt-3 mb-5" style="color: white !important;" href="ziyaret_resim_sil.php?id=<?php echo $item["id"] . "&geriId=" . $_GET["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/trash</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="4" y1="7" x2="20" y2="7"></line>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg></a></button>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".ck_editor").each(function(index) {
            var input_name = $(this).attr("name");
            CKEDITOR.replace(input_name);
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>