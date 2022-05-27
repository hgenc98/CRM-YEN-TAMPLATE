<script>
    function sil(id) {
        // alert(id);
        Swal.fire({
            title: 'Kayıtlı Olan Kullanıcıyı Silmek Üzeresiniz ! Hala Silmek İstiyormusunuz ?',
            text: 'Bunu İşlemi Asla Geri Alamazsınız!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',

            confirmButtonText: 'Sil Gitsin!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'kullanici_icerik/kullanici_sil.php?id=' + id;
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
include "../db.php";
include "../header.php";


$sql = $db->query('SELECT kullanicilar.*,roller.role_adi ,kullanici_subeler.sube_adi FROM kullanicilar
LEFT JOIN roller ON roller.id =kullanicilar.role_id
LEFT JOIN kullanici_subeler ON kullanici_subeler.id =kullanicilar.sube_id
where kullanicilar.firma_id = ' . $_SESSION["firma_id"] . '
');





?>
<div class="col-md-12">
    <div class="container">
        <?php
        $breadcrumbs = [["link" => "/kullanici_icerik/kullanici.php", "baslik" => "Kullanici"]];
        include "../breadcrumb.php"; ?>
        <?php
        $rol = $_SESSION['rol'];
        if ($rol == 1) { ?>

            <div class="bg-primary" style="text-align: end; float:right;border:1px solid gray;border-radius:20px;color:white"><strong><a class="nav-link" href="kullanici_ekle_form.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/user</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>KULLANICI EKLE</a></strong></div>

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
                                    <strong>
                                        <?php $kullanici_sayac = $db->query('SELECT COUNT(*) as sayac FROM kullanicilar   where kullanicilar.firma_id = ' . $_SESSION["firma_id"] . '')->fetch();
                                        echo ($kullanici_sayac["sayac"]);
                                        ?>
                                    </strong>
                                </div>
                                <hr>
                                <div class="text-muted text-center">
                                    KULLANICI
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div>
                <h3 class="mt-3 " style="color:red;text-align: center;">KULLANICI BİLGİLERİ</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>ADI SOYADI</th>
                                <th>E-MAİL</th>
                                <th>TELEFON NUMARASI</th>
                                <th>ROLÜ</th>
                                <th>ŞUBESİ</th>
                                <th>DÜZENLE</th>
                                <th>SİL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($sql as $item) {
                            ?>
                                <tr>
                                    <td><?php echo $item['kullanici_adi'] ?></td>
                                    <td><?php echo $item['e_posta'] ?></td>
                                    <td><?php echo $item['tel'] ?></td>
                                    <td><?php echo $item['role_adi'] ?></td>
                                    <td><?php echo $item['sube_adi'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-info"><a href="kullanici_duzenle_form.php?id=<?php echo $item["id"] ?>"><svg style="color:white" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
  