<?php
include "../header.php";
include "../db.php";
include "../islem2.php";


$sql = $db->query('SELECT * FROM kullanici_subeler where kullanici_subeler.firma_id = ' . $_SESSION["firma_id"] . '');
?>

<div class="container col-md-12">
    <?php

    $breadcrumbs = [["link" => "kullanici_icerik/kullanici_subeler.php", "baslik" => "Kullanici Subeleri"]];
    include "../breadcrumb.php";
    $rol = $_SESSION['rol'];
    if ($rol == 1) { ?>

        <div style="float:right;border:1px solid gray;border-radius:20px;color:white" class="bg-primary"><strong><a class="nav-link" href="kullanici_sube_ekle_form.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <desc>Download more icon variants from https://tabler-icons.io/i/user</desc>
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>ŞUBE EKLE</a></strong></div>

    <?php }  ?>
    <div class="d-flex justify-content-center ">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
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
                                <strong>
                                    <?php $sube_sayac = $db->query('SELECT COUNT(*) as sayac FROM kullanici_subeler  where kullanici_subeler.firma_id = ' . $_SESSION["firma_id"] . '')->fetch();
                                    echo ($sube_sayac["sayac"]);
                                    ?>
                                </strong>
                            </div>
                            <hr>
                            <div class="text-muted text-center">
                                KULLANICI ŞUBELERİ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 ">
        <div class="card mt-5">
            <div style="text-align: -webkit-center;">
                <h5 class="mt-3 " style="color:red;">KULLANICI BİLGİLERİ</h5>
            </div>
            <div class="container">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable mt-3">
                        <thead>
                            <thead style="color:black">
                                <tr>
                                    <th>ŞUBE ADI</th>
                                    <th>YETKİLİ ADI</th>
                                    <th>YETKİLİ TEL NO</th>
                                    <th>YETKİLİ E-POSTA</th>
                                    <th>DÜZENLE</th>
                                    <th>SİL</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php
                            foreach ($sql as $item) {
                            ?>
                                <tr>
                                    <td><?php echo $item['sube_adi'] ?></td>
                                    <td><?php echo $item['yetkili_adi'] ?></td>
                                    <td><?php echo $item['yetkili_telefon'] ?></td>
                                    <td><?php echo $item['e_posta'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-info"><a href="kullanici_sube_duzenle_form.php?id=<?php echo $item["id"] ?>"><svg style="color:white" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <desc>Download more icon variants from https://tabler-icons.io/i/file-pencil</desc>
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                    <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
                                                </svg></a></button>
                                    </td>
                                    <td style="color:black;" class="card-header ">
                                        <button type="button" class="btn btn-danger"><a style="color: white !important;" href="kullanici_sube_sil.php?id=<?php echo $item["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <desc>Download more icon variants from https://tabler-icons.io/i/trash</desc>
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="4" y1="7" x2="20" y2="7"></line>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                            </svg></a></button>
                                    </td>
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
<script src="../dist/js/tabler.min.js"></script>
<script src="../dist/js/demo.min.js"></script>