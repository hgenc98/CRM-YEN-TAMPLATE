<script>
    function sil(id) {
        //alert(id);
        Swal.fire({
            title: 'Şuan da Silmek Üzere Oldugun Dosyalar Sunlar : Musteri Eleman , Musteriler Ve Ziyaretler; Hala Silmek İstiyormusun ?',
            text: 'Bunu İşlemi Geri Alamazsınız!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',

            confirmButtonText: 'Sil Gitsin!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'musteri_icerik/musteriler_sil.php?id=' + id;
                Swal.fire(
                    'Başarı İle Silindi !',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }
</script>

<?php
include "../header.php";
include "../db.php";
include "../islem2.php";

    $sql = $db->query('SELECT musteriler.id as id, musteriler.adres, musteri_eleman.eleman_adi, musteriler.musteri_adi, musteriler.baslik, musteriler.telefon_no  
  FROM musteriler LEFT JOIN musteri_eleman on musteriler.id = musteri_eleman.musteri_id
   where musteriler.firma_id = ' . $_SESSION["firma_id"] . '')->fetchAll();

    $eleman = $db->query('SELECT * FROM  musteri_eleman   where id = musteri_id')->fetch();

    ?>
    <div class="col-md-12 page">
        <div class="container">
            <div class="col-12">

                <?php
                $breadcrumbs = [["link" => "musteriler.php", "baslik" => "Musteriler"]];
                include "../breadcrumb.php";
                $rol = $_SESSION['rol'];
                if ($rol == 1) { ?>
                    <div class="d-flex justify-content-end">
                        <div style="float:right;border:1px solid gray;border-radius:20px;color:white" class="mr-4 bg-primary"><strong><a class="nav-link" href="musteri_ekle_form.php">MÜŞTERİ EKLE</a></strong></div>
                        <div style="float:right;border:1px solid gray;border-radius:20px;color:white" class="bg-primary"><strong><a class="nav-link" href="musteri_eleman_ekle_form.php">MÜŞTERİ ELEMAN EKLE</a></strong></div>
                    </div>
                    <br>
                <?php }  ?>
            </div>


            <div class="d-flex justify-content-center  ">
                <div class="col-sm-6 col-lg-3 ">
                    <div class="card card-sm  mb-3 " style="width: 190px;">
                        <div class="card-body " style="border-radius: 20px;">
                            <div class="row align-items-center">
                                <div class="col-auto text-center">
                                    <a href="musteriler.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <desc>Download more icon variants from https://tabler-icons.io/i/user</desc>
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg></a>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium text-center">
                                        <strong>
                                            <?php $musteri_sayac = $db->query('SELECT COUNT(*) as sayac FROM musteriler  where musteriler.firma_id = ' . $_SESSION["firma_id"] . '')->fetch();
                                            echo ($musteri_sayac["sayac"]);
                                            ?>
                                        </strong>
                                    </div>
                                    <hr>
                                    <div class="text-muted text-center">
                                        Müşterilerimiz
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-12 ">
                <div class="card mt-5">
                    <div style="color:brown;text-align: -webkit-center;">
                        <h2 class="mt-3">MÜŞTERİ BİLGİLERİ</h2>
                    </div>
                    <div class="table-responsive container">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead style="color:black">
                                <tr>
                                    <th>BAŞLIK </th>
                                    <th>MÜŞTERİ ADI SOYADI </th>
                                    <th>MÜŞTERİ ELEMAN ADI SOYADI </th>
                                    <th>TELEFON NUMARASI </th>
                                    <th>AÇIK ADRESS</th>
                                    <th>DÜZENLE</th>
                                    <th>SİL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($sql as $item) {
                                ?>
                                    <tr>
                                        <td><?php echo $item['baslik'] ?></td>
                                        <td><?php echo $item['musteri_adi'] ?></td>
                                        <td><?php echo $item['eleman_adi'] ?></td>
                                        <td><?php echo $item['telefon_no'] ?></td>
                                        <td><?php echo $item['adres'] ?></td>
                                        <td><button type="button" class="btn btn-info">
                                                <a href="musteri_duzenle_form.php?id=<?php echo $item["id"] ?>"><svg style="color:white" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <desc>Download more icon variants from https://tabler-icons.io/i/file-pencil</desc>
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                        <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
                                                    </svg></a></button></td>
                                        <td style="color:black" class="card-header">
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