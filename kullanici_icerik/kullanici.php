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
where kullanicilar.firma_id = ' . $_SESSION['kullanici']["firma_id"] . '
');

?>
<div class="col-md-12 page">
    <div class="container">
        <?php
        $breadcrumbs =
            [
                [
                    "link" => "kullanici.php",
                    "baslik" => "Kullanici"
                ]
            ];
        $butonlar = [
            [
                "ad" => "Kullanıcı Ekle",
                "renk" => "primary",
                "ikon" => "user",
                "link" => "kullanici_ekle_form.php"
            ]
        ];
        include "../breadcrumb.php"; ?>
        <div class="card mt-3">
            <div class="d-flex ">
                <div class="mx-auto">
                    <h2 class="mt-3 text-danger" style="text-align: center;">KULLANICI BİLGİLERİ</h2>
                </div>
               
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
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <a style="" href="kullanici_duzenle_form.php?id=<?php echo $item["id"] ?>"><svg style="color:white" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <desc>Download more icon variants from https://tabler-icons.io/i/file-pencil</desc>
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                        <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
                                                    </svg></a>
                                            </span>
                                        </div>

                                    </td>
                                    <td class="card-header ">
                                        <div class="col-auto">
                                            <span class="bg-danger text-white avatar">
                                                <a onclick="sil(<?php echo $item['id']; ?>)"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <desc>Download more icon variants from https://tabler-icons.io/i/trash</desc>
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <line x1="4" y1="7" x2="20" y2="7"></line>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg></a>
                                            </span>
                                        </div>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <p class="ps-3 text-primary">SİSTEMDE KAYITLI OLAN KULLANICI SAYISI </p>
                <p class="ps-3 text-primary">=</p>
                <div class="ps-3 mb-3 text-primary">

                    <?php $kullanici_sayac = $db->query('SELECT COUNT(*) as sayac FROM kullanicilar   where kullanicilar.firma_id = ' . $_SESSION['kullanici']["firma_id"] . '')->fetch();
                    echo ($kullanici_sayac["sayac"]);
                    ?>

                </div>
            </div>
        </div>
    </div>