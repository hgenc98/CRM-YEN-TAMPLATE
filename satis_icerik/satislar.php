<script>
    function sil(id) {
        // alert(id);
        Swal.fire({
            title: 'Yapılan Satışı Silmek Üzeresiniz ! Hala Silmek İstiyormusunuz ?',
            text: 'Bunu İşlemi Asla Geri Alamazsınız!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',

            confirmButtonText: 'Sil Gitsin!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'satislar_sil.php?id=' + id;
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



$sql = $db->prepare('SELECT * FROM satislar ');


if ($_SESSION['kullanici']['role_id'] == 1) {

    $sql = $db->prepare('SELECT satislar.*, satislar.satis_tarihi,satis_not,musteriler.musteri_adi as musteri_adi , kullanicilar.kullanici_adi FROM satislar
    INNER JOIN musteriler ON musteriler.id = satislar.musteri_id
    INNER JOIN kullanicilar ON kullanicilar.id = satislar.kullanici_id
    where  satislar.firma_id=' . $_SESSION['kullanici']["firma_id"] . '
    ');
    $data = $sql->execute(['id' => $_SESSION['kullanici']['id']]);
    $sql = $sql->fetchAll();
} else {

    isset($_SESSION['kullanici_id']);
    $sql = $db->prepare('SELECT satislar.*,musteriler.musteri_adi as musteri_adi , kullanicilar.kullanici_adi , satislar.id as satis_id1 FROM satislar
    INNER JOIN musteriler ON musteriler.id = satislar.musteri_id
    INNER JOIN kullanicilar ON kullanicilar.id = satislar.kullanici_id
    where satislar.kullanici_id=:id AND satislar.firma_id=' .  $_SESSION['kullanici']["firma_id"] . '');
    $data = $sql->execute(['id' => $_SESSION['kullanici']['id']]);
    $sql = $sql->fetchAll();
}
?>
<div class="col-md-12  container">
    <?php
    $breadcrumbs =
        [
            [
                "link" => "satislar.php",
                "baslik" => "Satislar"
            ]
        ];
    $butonlar = [
        [
            "ad" => "Satış Ekle",
            "renk" => "primary",
            "ikon" => "dollar",
            "link" => "satis_ekle_form.php"

        ]
    ];
    include "../breadcrumb.php";

    ?>

    <div class="card mt-3">
        <div class="d-flex container ">
            <div class="mx-auto">
                <h2 class="mt-3 text-danger" style="text-align: center;">SATIŞ BİLGİLERİ</h2>
            </div>
           
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

                            <?php $rol = $_SESSION['kullanici']['role_id'];
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


                                <?php $rol = $_SESSION['kullanici']['role_id'];
                                if ($rol == 1) { ?>
                                    <td>
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <a href="satis_duzenle_form.php?id=<?php echo $item["id"] ?>"><svg style="color:white" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                            <span class="bg-danger text-white avatar mt-3">
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
        <div class="card-footer  d-flex justify-content-center">
            <p class="ps-3 mt-3 text-primary">SİSTEMDE KAYITLI OLAN SATIŞLARIMIZIN SAYISI </p>
            <p class="ps-3 mt-3 text-primary">=</p>
            <div class="ps-3 mb-3  mt-3 text-primary">
                <?php $satis_sayac = $db->query('SELECT COUNT(*) as sayac FROM satislar where satislar.firma_id = ' . $_SESSION['kullanici']["firma_id"] . '')->fetch();
                echo ($satis_sayac["sayac"]);
                ?>

            </div>

        </div>
    </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>