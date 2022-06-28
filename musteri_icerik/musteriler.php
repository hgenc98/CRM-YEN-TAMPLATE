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
   where musteriler.firma_id = ' . $_SESSION['kullanici']["firma_id"] . '')->fetchAll();

$eleman = $db->query('SELECT * FROM  musteri_eleman   where id = musteri_id')->fetch();

?>
<div class="container">
    <?php
    $breadcrumbs = [
        [
            "link" => "musteriler.php", 
            "baslik" => "Musteriler",
        ]
    ];
    $butonlar = [[
        "ad"=>"Müşteri Ekle",
        "renk"=>"primary",
        "ikon"=>"user",
        "link"=>"musteri_ekle_form.php"

    ]
    ];
    $rol = $_SESSION['kullanici']['role_id'];
    include "../breadcrumb.php";
    ?>

    <div class="card mt-3">
        <div class="d-flex container ">
            <div class="mx-auto">
                <h2 class="mt-3 text-danger">MÜŞTERİ BİLGİLERİ</h2>
            </div>
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


                            <td>
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <a href="musteri_duzenle_form.php?id=<?php echo $item["id"] ?>"><svg style="color:white" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <desc>Download more icon variants from https://tabler-icons.io/i/file-pencil</desc>
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
                                            </svg></a>
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
        <p class="ps-3 text-primary">SİSTEMDE KAYITLI OLAN MÜŞTERİ SAYISI </p>
        <p class="ps-3 text-primary">=</p>
        <div class="ps-3 mb-3 text-primary">

            <?php $musteri_sayac = $db->query('SELECT COUNT(*) as sayac FROM musteriler  where musteriler.firma_id = ' . $_SESSION['kullanici']["firma_id"] . '')->fetch();
            echo ($musteri_sayac["sayac"]);
            ?>

        </div>
    </div>
</div>