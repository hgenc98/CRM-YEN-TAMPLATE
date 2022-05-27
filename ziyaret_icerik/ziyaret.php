<script>
    function sil(id) {
        // alert(id);
        Swal.fire({
            title: 'Yapılan Ziyareti Silmek Üzeresiniz ! Hala Silmek İstiyormusunuz ?',
            text: 'Bunu İşlemi Asla Geri Alamazsınız!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',

            confirmButtonText: 'Sil Gitsin!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'ziyaret_icerik/ziyaret_sil.php?id=' + id;
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
include "../islem2.php";
include "../header.php";
if (isset($_GET['ziyaret'])) {

    echo '<script>Swal.fire("Başarılı", "Mesajınız Elemanınıza ulaştı", "success"); </script>';
}


$musteri = $db->query("SELECT * FROM musteriler ")->fetch();

if ($_POST) {
    $sql = $db->prepare("UPDATE ziyaretler set durum='1',tarih=CURRENT_TIMESTAMP WHERE id = ?");
    $sql->execute([$_POST['id']]);
}

if ($_SESSION['rol'] == 1) {
    $sql = $db->prepare('SELECT ziyaretler.*,tamamlayan.kullanici_adi as tamamlayan_adi,musteriler.musteri_adi,musteri_eleman.eleman_adi, musteriler.baslik as baslik FROM ziyaretler
    LEFT JOIN musteriler ON ziyaretler.musteri_id =musteriler.id
    LEFT JOIN kullanicilar as tamamlayan on ziyaretler.tamamlayan_id = tamamlayan.id
    LEFT JOIN musteri_eleman  on musteri_eleman.id = ziyaretler.musteri_eleman_id
    WHERE tamamlayan_id = :id AND ziyaretler.firma_id =' . $_SESSION["firma_id"] . '');
    $data = $sql->execute(['id' => $_SESSION['kullanici_id']]);
    $sql = $sql->fetchAll();
} else {
    isset($_SESSION['kullanici_id']);
    $sql = $db->prepare('SELECT ziyaretler.*,tamamlayan.kullanici_adi AS tamamlayan_adi,musteriler.musteri_adi,musteri_eleman.eleman_adi,musteriler.baslik AS baslik FROM ziyaretler
    LEFT JOIN musteriler ON ziyaretler.musteri_id = musteriler.id
    LEFT JOIN kullanicilar AS tamamlayan ON ziyaretler.tamamlayan_id = tamamlayan.id
    LEFT JOIN musteri_eleman ON musteri_eleman.id = ziyaretler.musteri_eleman_id
    WHERE tamamlayan_id = :id AND ziyaretler.firma_id = ' . $_SESSION["firma_id"] . ' ');
    $data = $sql->execute(['id' => $_SESSION['kullanici_id']]);
    $sql = $sql->fetchAll();
}
?>
<div class="container col-12">

    <?php
    $breadcrumbs = [["link" => "ziyaret.php", "baslik" => "Ziyaret"]];
    include "../breadcrumb.php";
    $rol = $_SESSION['rol'];
    if ($rol == 1) { ?>

        <div style="float:right;border:1px solid gray;border-radius:20px;margin-left:50px;color:white" class="mt-2 bg-primary"><strong><a class="nav-link" href="ziyaret_ekle_form.php">ZİYARET YERİ EKLE</a></strong></div>

    <?php }  ?>

    <form action="ziyaret.php" method="POST">
        <div style="text-align: -webkit-center;" class="bg-light ">
            <div class="d-flex justify-content-between">
                <?php $rol = $_SESSION['rol'];
                if ($rol == 1) { ?>


                    <div class="col-sm-4 col-lg-4" style="width: 220px;">
                        <div class="card">
                            <div class="card-body">
                                <div class=" text-center">
                                    <h4>
                                        <?php $satis_sayac = $db->query('SELECT COUNT(*) as sayac FROM ziyaretler  where ziyaretler.firma_id = ' . $_SESSION["firma_id"] . '')->fetch();
                                        echo ($satis_sayac["sayac"]);
                                        ?>
                                        <br>
                                        <hr>
                                        ZİYARETLERİMİZ
                                    </h4>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4"style="width: 220px;">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <h4>
                                        <?php $satis_sayac3 = $db->query('SELECT COUNT(*) as sayac FROM ziyaretler where  durum=1 ')->fetch();

                                        echo ($satis_sayac3["sayac"]);
                                        ?>
                                        <br>
                                        <hr>
                                        TAMAMLANAN
                                    </h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 "style="width: 220px;">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <h4>
                                        <?php $satis_sayac3 = $db->query('SELECT COUNT(*) as sayac FROM ziyaretler where  durum=0 ')->fetch();


                                        echo ($satis_sayac3["sayac"]);
                                        ?>
                                        <br>
                                        <hr>
                                        <h4>BEKLEYEN</h4>
                                    </h4>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>


        <?php }
        ?>
        </div>
</div>
</div>
<div class="col-12 container">
    <div class="d-flex justify-content-center container">
        <?php $rol = $_SESSION['rol'];
        if ($rol == 2) { ?>


            <div class="kutu3 ">
                <h4>

                    <?php $satis_sayac2 = $db->prepare('SELECT COUNT(*) as sayac FROM ziyaretler where tamamlayan_id=:kullanici_id');
                    $data = $satis_sayac2->execute(['kullanici_id' => $_SESSION['kullanici_id']]);
                    $satis_sayac2 = $satis_sayac2->fetch();
                    echo ($satis_sayac2["sayac"]);
                    ?>
                    <br>
                    <hr>
                    ZİYARETLERİMİZ

                </h4>
            </div>
            <div class="kutu3 ">
                <h4>
                    <?php $satis_sayac2 = $db->prepare('SELECT COUNT(*) as sayac FROM ziyaretler where tamamlayan_id=:kullanici_id and durum=0 ');
                    $data = $satis_sayac2->execute(['kullanici_id' => $_SESSION['kullanici_id']]);
                    $satis_sayac2 = $satis_sayac2->fetch();
                    echo ($satis_sayac2["sayac"]);
                    ?>
                    <br>
                    <hr>
                    <button type="button" class="btn btn-danger"><i style="color: white;" class="fa-thin fa-x"></i></button>
                </h4>
            </div>


            <div style="text-align: -webkit-center;">
                <div class="kutu3 ">
                    <h4>
                        <?php $satis_sayac2 = $db->prepare('SELECT COUNT(*) as sayac FROM ziyaretler where tamamlayan_id=:kullanici_id and durum=1 ');
                        $data = $satis_sayac2->execute(['kullanici_id' => $_SESSION['kullanici_id']]);
                        $satis_sayac2 = $satis_sayac2->fetch();
                        echo ($satis_sayac2["sayac"]);
                        ?>
                        <br>
                        <hr>
                        <button type="button" class="btn btn-info"><i style="color: white;" class="fa-solid fa-check"></i></button>
                    </h4>
                </div>
            </div>
    </div>
<?php } ?>
</div>
</div>


<div class="col-12 container">
    <div class="card mt-5">
        <div>
            <h3 class="mt-3 " style="color:red;text-align: center;">ZİYARET BİLGİLERİ</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive overflow-x">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th>GÖREVLİ</th>
                            <th>ŞİRKET</th>
                            <th>M.ELEMAN</th>
                            <th>M.ADRESİ</th>
                            <th>M.TELEFON</th>
                            <th>TAMAMLANACAK TARİH</th>
                            <th>AÇIKLAMA</th>
                            <th>DETAY</th>
                            <?php $rol = $_SESSION['rol'];
                            if ($rol == 1 or 2) { ?>
                                <th>TAMAMLANDI</th>
                                <th>TAMAMLANAN TARİH</th>

                            <?php }
                            ?>
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
                        ?>
                            <tr>
                                <td><?php echo $item['tamamlayan_adi'] ?></td>
                                <td><?php echo $item['baslik'] ?></td>
                                <td><?php echo $item['eleman_adi'] ?></td>
                                <td><?php echo $item['musteri_adres'] ?></td>
                                <td><?php echo $item['tel_no'] ?></td>
                                <td><?php echo (new DateTime($item['tamamlanacak_tarih']))->format("d/m/Y h:i:s"); ?></td>
                                <td><?php echo mb_substr($item['aciklama'], 0, 8) . '...' ?></td>
                                <td><button style="border: none;background: none;" type="button" class="btn btn-light">
                                        <a href="ziyaret_aciklama_detay.php?id=<?php echo $item["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <desc>Download more icon variants from https://tabler-icons.io/i/file-description</desc>
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                <path d="M9 17h6"></path>
                                                <path d="M9 13h6"></path>
                                            </svg> </a></button></td>

                                <?php $rol = $_SESSION['rol'];
                                if ($rol == 1) { ?>
                                    <form action="ziyaret.php" method="POST">
                                        <input type="hidden" name='id' value="<?php echo $item['id'] ?>">

                                        <td>
                                            <?php if ($item['durum'] == 1) {
                                            ?>
                                                <strong><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <desc>Download more icon variants from https://tabler-icons.io/i/checks</desc>
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 12l5 5l10 -10"></path>
                                                        <path d="M2 12l5 5m5 -5l5 -5"></path>
                                                    </svg></strong></i>
                                            <?php
                                            } else { ?>
                                                <strong><button class="bg-primary" style="border: none;color:white"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-letter-x " width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <desc>Download more icon variants from https://tabler-icons.io/i/letter-x</desc>
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <line x1="7" y1="4" x2="17" y2="20"></line>
                                                            <line x1="17" y1="4" x2="7" y2="20"></line>
                                                        </svg></button></strong>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </form>
                                <?php }
                                ?>
                                <?php $rol = $_SESSION['rol'];
                                if ($rol == 2) { ?>
                                    <form action="ziyaret.php" method="POST">
                                        <input type="hidden" name='id' value="<?php echo $item['id'] ?>">

                                        <td>
                                            <?php if ($item['durum'] == 1) {

                                            ?>

                                                <button type="button" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <desc>Download more icon variants from https://tabler-icons.io/i/checks</desc>
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 12l5 5l10 -10"></path>
                                                        <path d="M2 12l5 5m5 -5l5 -5"></path>
                                                    </svg></button>
                                                </i><?php
                                                } else { ?>
                                                <input style="color: black;font-weight: bold;" class="btn btn-danger" type="submit" value="X">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-letter-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <desc>Download more icon variants from https://tabler-icons.io/i/letter-x</desc>
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <line x1="7" y1="4" x2="17" y2="20"></line>
                                                    <line x1="17" y1="4" x2="7" y2="20"></line>
                                                </svg>

                                            <?php } ?>
                                        </td>
                                    </form>
                                <?php }
                                ?>
                                <?php $rol = $_SESSION['rol'];
                                if ($rol == 1 or 2) { ?>
                                    <td><?php echo (new DateTime($item['tarih']))->format("d/m/y h:i:s A"); ?></td>
                                <?php }
                                ?>



                                <?php if ($item['durum'] == 1) {
                                ?>
                                    <?php $rol = $_SESSION['rol'];
                                    if ($rol == 1) { ?>
                                        <td>-</td>
                                        <td>-</td>
                                    <?php } ?>

                                <?php
                                } else { ?>
                                    <?php $rol = $_SESSION['rol'];
                                    if ($rol == 1) { ?>
                                        <td><button type="button" class="btn btn-info">
                                                <a href="ziyaret_duzenle_form.php?id=<?php echo $item["id"] ?>"><svg style="color:white" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <desc>Download more icon variants from https://tabler-icons.io/i/file-pencil</desc>
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                        <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
                                                    </svg></a></button></td>
                                        <td>
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
</form>


<script type="text/javascript">
    function button() {
        alert("başarıyla tamamlandı");
    }
</script>

</body>

</html>