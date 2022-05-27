<?php
include "../header.php";
include "../db.php";



$sql = $db->prepare('SELECT * FROM satislar ');


if ($_SESSION['rol'] == 1) {

    $sql = $db->prepare('SELECT satislar.*, satislar.satis_tarihi,satis_not,musteriler.musteri_adi as musteri_adi , kullanicilar.kullanici_adi FROM satislar
    INNER JOIN musteriler ON musteriler.id = satislar.musteri_id
    INNER JOIN kullanicilar ON kullanicilar.id = satislar.kullanici_id
    where satislar.kullanici_id=:id AND satislar.firma_id=' . $_SESSION["firma_id"] . '
    ');
    $data = $sql->execute(['id' => $_SESSION['kullanici_id']]);
    $sql = $sql->fetchAll();
} else {

    isset($_SESSION['kullanici_id']);
    $sql = $db->prepare('SELECT satislar.*,musteriler.musteri_adi as musteri_adi , kullanicilar.kullanici_adi , satislar.id as satis_id1 FROM satislar
    INNER JOIN musteriler ON musteriler.id = satislar.musteri_id
    INNER JOIN kullanicilar ON kullanicilar.id = satislar.kullanici_id
    where satislar.kullanici_id=:id AND satislar.firma_id=' . $_SESSION["firma_id"] . '');
    $data = $sql->execute(['id' => $_SESSION['kullanici_id']]);
    $sql = $sql->fetchAll();
}
?>
<div class="col-md-12">
    <div class="container">
        <?php
        $breadcrumbs = [["link" => "satislar.php", "baslik" => "Satislar"]];
        include "../breadcrumb.php";

        $rol = $_SESSION['rol'];
        if ($rol == 1) { ?>


            <div class="bg-primary" style="text-align: end; float:right;border:1px solid gray;border-radius:20px;color:white"><strong><a class="nav-link" href="satis_ekle_form.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/user</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>SATIŞ EKLE</a></strong></div>

        <?php }  ?>
        <div class="d-flex justify-content-center ">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm ">
                    <div class="card-body" style="border-radius: 20px;">
                        <div class="row align-items-center">
                            <div class="col-auto text-center">
                                <a href="musteri_icerik/musteriler.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <desc>Download more icon variants from https://tabler-icons.io/i/user</desc>
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg></a>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium text-center">
                                    <h4>
                                        <?php $satis_sayac = $db->query('SELECT COUNT(*) as sayac FROM satislar where satislar.firma_id = ' . $_SESSION["firma_id"] . '')->fetch();
                                        echo ($satis_sayac["sayac"]);
                                        ?>
                                        <hr>
                                        SATIŞLARIMIZ

                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

            <div class="col-12 ">
                <div class="card mt-5">
                    <div>
                        <h3 class="mt-3 " style="color:red;text-align: center;">SATIŞ BİLGİLERİ</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>MUSTERİ ADI SOYADI</th>
                                        <th>PERSONELİN ADI SOYADI</th>
                                        <th>SATIŞ TARİHİ</th>
                                        <th>SATIŞ NOT</th>
                                        <th>ADET</th>
                                        <th>SATIŞ DETAYI</th>

                                        <?php $rol = $_SESSION['rol'];
                                        if ($rol == 1) { ?>
                                            <th>DÜZENLE</th>
                                            <th>SİL</th>
                                        <?php }
                                        ?>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($sql as $item) {

                                        $sql1 = $db->prepare('SELECT * FROM satis_kalemleri where satis_id=?');
                                        $EKLEYAZ = $sql1->execute([$item['id']]);
                                        $data = $sql1->fetchAll();

                                    ?>

                                        <tr>
                                            <td><?php echo $item['musteri_adi'] ?></td>
                                            <td><?php echo $item['kullanici_adi'] ?></td>
                                            <td><?php echo (new DateTime($item['satis_tarihi']))->format("d/m/y h:i:s") ?></td>
                                            <td><?php echo $item['satis_not'] ?></td>
                                            <td><?php echo count($data) ?></td>
                                            <td><a href="satis_detay.php?id=<?php echo $item["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <desc>Download more icon variants from https://tabler-icons.io/i/file-description</desc>
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                        <path d="M9 17h6"></path>
                                                        <path d="M9 13h6"></path>
                                                    </svg></a></td>


                                            <?php $rol = $_SESSION['rol'];
                                            if ($rol == 1) { ?>
                                                <td>
                                                    <button type="button" class="btn btn-info"><a href="satis_duzenle_form.php?id=<?php echo $item["id"] ?>"><svg style="color:white" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <desc>Download more icon variants from https://tabler-icons.io/i/file-pencil</desc>
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                                <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
                                                            </svg></a></button>
                                                </td>
                                                <td class="card-header ">
                                                    <a onclick="sil(<?php echo $item['id']; ?>)" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <desc>Download more icon variants from https://tabler-icons.io/i/trash</desc>
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <line x1="4" y1="7" x2="20" y2="7"></line>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                        </svg></a>
                                                </td>
                                            <?php }
                                            ?>


                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>