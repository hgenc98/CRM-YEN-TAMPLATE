<?php
include "../header.php";
include "../db.php";
include "../islem2.php";
/*

$sql = $db->prepare('SELECT * FROM satis_kalemleri where satis_kalemleri.satis_id=:id');
$sql->execute([
    'id' => $_GET['id'],
]);

*/

if ( $_SESSION['kullanici']['role_id'] == 1) {
    $satis = $db->prepare('SELECT satis_kalemleri.*,kullanicilar.kullanici_adi as kullanici_adi FROM satis_kalemleri
    LEFT JOIN satislar ON satislar.id = satis_kalemleri.satis_id
    LEFT JOIN kullanicilar ON kullanicilar.id = satislar.kullanici_id
    where satis_kalemleri.satis_id=:id 
    ');
    $satis->execute(['id' => $_GET['id']]);
    $satis = $satis->fetchAll();
} else {
    isset($_SESSION['kullanici_id']);
    $satis = $db->prepare('SELECT satis_kalemleri.*,kullanicilar.kullanici_adi as kullanici_adi FROM satis_kalemleri
  LEFT JOIN satislar ON satislar.id = satis_kalemleri.satis_id
    LEFT JOIN kullanicilar ON kullanicilar.id = satislar.kullanici_id
    where satis_kalemleri.satis_id=:id
    ');
    $satis->execute(['id' => $_GET['id']]);
    $satis = $satis->fetchAll();
}
?>

<div class="col-12 container">
<?php
$breadcrumbs = [["link" => "satislar.php", "baslik" => "Satislar"], ["link" => "satis_detay.php?id=" . $_GET["id"], "baslik" => "Satis Detay"]];
include "../breadcrumb.php"; ?>

    <div class="card mt-5">
        <div>
            <h3 class="mt-3 " style="color:red;text-align: center;">SATIŞ BİLGİLERİ</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th>SATIŞ YAPAN KİŞİ</th>
                            <th>ÜRÜN ADI</th>
                            <th>ÜRÜN ADEDİ</th>
                            <th>BİRİM FİYATI</th>
                            <th>EKLENME TARİHİ</th>
                            <th>GÜNCELLEME TARİHİ</th>

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
                        foreach ($satis as $item) {

                        ?>
                            <tr>
                                <td><?php echo $item['kullanici_adi'] ?></td>
                                <td><?php echo $item['urun_adi'] ?></td>
                                <td><?php echo $item['adet'] ?> ADET</td>
                                <td><?php echo $item['birim_fiyati'] ?> ₺</td>
                                <td><?php echo (new DateTime($item['eklenme_tarihi']))->format("d/m/y h:i:s") ?></td>
                                <td><?php echo (new DateTime($item['guncelleme_tarihi']))->format("d/m/y h:i:s") ?></td>


                                <?php $rol =  $_SESSION['kullanici']['role_id'];
                                if ($rol == 1) { ?>
                                    <td><button type="button" class="btn btn-info"><a href="satis_kalemleri_duzenle_form.php?id=<?php echo $item['id'] ?>"><svg style="color:white" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <desc>Download more icon variants from https://tabler-icons.io/i/file-pencil</desc>
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                    <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
                                                </svg></a></td>

                                    <td><button type="button" class="btn btn-danger"><a style="color: white !important;" href="satislar_sil.php?id=<?php echo $_GET["id"]; ?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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