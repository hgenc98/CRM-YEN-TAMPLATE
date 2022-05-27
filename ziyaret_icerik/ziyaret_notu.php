<?php

use function PHPSTORM_META\sql_injection_subst;

include "../header.php";
include "../db.php";




if ($_POST) {
    $sql = $db->prepare("UPDATE ziyaretler set durum='1',tarih=CURRENT_TIMESTAMP WHERE id = ?");
    $sql->execute([$_POST['id']]);
    die;
    header("Location:ziyaret.php");
}

if ($_SESSION['rol'] == 1) {
    $sql = $db->query('SELECT ziyaret_notu.*,kullanici_id.kullanici_adi as kullanici_adi,ziyaretler.musteri_id as musteri_adi, FROM ziyaret_notu
    LEFT JOIN kullanicilar as kullanici_adi on ziyaret_notu.kullanici_id = kullanici.id
    LEFT JOIN ziyaretler  on musteri_id = ziyaret_notu.musteri_id');
} else {
    isset($_SESSION['kullanici_id']);
    $sql = $db->prepare('SELECT ziyaret_notu.*,kullanici_id.kullanici_adi as kullanici_adi,ziyaretler.musteri_id as musteri_adi, FROM ziyaret_notu
    LEFT JOIN kullanicilar as kullanici_adi on ziyaret_notu.kullanici_id = kullanici.id
    LEFT JOIN ziyaretler  on musteri_id = ziyaret_notu.musteri_id
    where tamamlayan_id=:id');
    $data = $sql->execute(['id' => $_SESSION['kullanici_id']]);
    $sql = $sql->fetchAll();
}

?>

<div class="col-12">   
    <form action="ziyaret_icerik/ziyaret.php" method="POST">
        <div class="row">
            <div class="col-12">
                <h4 class="mt-3 " style="color:red;text-align: center; ">ZİYARET BİLGİLERİ</h4>
                <div style="color:black;overflow-x:auto" class="card border-success mt-3">
                    <table style="color:black ; background-color:rgb(187, 191, 196); opacity:0.8;" class="card-body text-success">
                        <thead style="color:black" class="card-header bg-transparent border-success">
                            <tr style="color:red">
                                <th class="card-header bg-transparent border-success" scope="col">AÇIKLAMA NOTU</th>
                                <th class="card-header bg-transparent border-success" scope="col">ZİYARET YERİ</th>
                                <th class="card-header bg-transparent border-success" scope="col">NOTUN EKLENEN TARİHİ</th>
                                <th class="card-header bg-transparent border-success" scope="col">AÇIKLAMA</th>
                                <th class="card-header bg-transparent border-success" scope="col">DETAY</th>
                                <?php $rol = $_SESSION['rol'];
                                if ($rol == 1 or 2) { ?>
                                    <th class="card-header bg-transparent border-success" scope="col">TAMAMLANDI</th>
                                    <th class="card-header bg-transparent border-success" scope="col">TAMAMLANAN TARİH</th>

                                <?php }
                                ?>
                                <?php $rol = $_SESSION['rol'];
                                if ($rol == 1) { ?>
                                    <th class="card-header bg-transparent border-success" scope="col">DÜZENLE</th>
                                    <th class="card-header bg-transparent border-success" scope="col">SİL</th>
                                <?php }
                                ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($sql as $item) {
                            ?>
                                <tr>
                                    <td style="color:black" class="card-header bg-transparent border-success"><?php echo substr($item['aciklama'], 0, 5) . '...' ?></td>
                                    <td style="color:black" class="card-header bg-transparent border-success"><?php echo $item['kullanici_adi'] ?></td>
                                    <td style="color:black" class="card-header bg-transparent border-success"><?php echo $musteri['musteri_adi'] ?></td>
                                    <td style="color:black" class="card-header bg-transparent border-success"><?php echo $item['eklenen_tarih'] ?></td>
                                    <td><a href="ziyaret_icerik/ziyaret_aciklama_detay.php?id=<?php echo $item["id"] ?>">DETAY GÖRÜNTÜLE</a></td>

                                    <?php $rol = $_SESSION['rol'];
                                    if ($rol == 1) { ?>
                                        <form action="" method="POST">
                                            <input type="hidden" name='id' value="<?php echo $item['id'] ?>">

                                            <td style="text-align: center;">
                                                <?php if ($item['durum'] == 1) {
                                                ?>
                                                    <i style="color: black;" class="fa-solid fa-check">
                                                    </i><?php
                                                    } else { ?>
                                                    <p style="color: black;">TAMAMLANMADI</p>
                                                <?php } ?>
                                            </td>
                                        </form>
                                    <?php }
                                    ?>
                                    <?php $rol = $_SESSION['rol'];
                                    if ($rol == 2) { ?>
                                        <form action="ziyaret_icerik/ziyaret.php" method="POST">
                                            <input type="hidden" name='id' value="<?php echo $item['id'] ?>">

                                            <td style="text-align: center;">
                                                <?php if ($item['durum'] == 1) {
                                                ?>
                                                    <i style="color: black;" class="fa-solid fa-check">
                                                    </i><?php
                                                    } else { ?>
                                                    <input type="submit" value="TAMAMLANMADI">
                                                <?php } ?>
                                            </td>
                                        </form>
                                    <?php }
                                    ?>
                                    <?php $rol = $_SESSION['rol'];
                                    if ($rol == 1 or 2) { ?>
                                        <td style="color:black" class="card-header bg-transparent border-success"><?php echo $item['tarih'] ?></td>
                                    <?php }
                                    ?>
                                    <?php $rol = $_SESSION['rol'];
                                    if ($rol == 1) { ?>
                                        <td style="color:black" class="card-header bg-transparent border-success"><a href="ziyaret_icerik/ziyaret_duzenle_1.php?id=<?php echo $item["id"] ?>">düzenle</a></td>
                                        <td style="color:black" class="card-header bg-transparent border-success"><a href="ziyaret_icerik/ziyaret_sil.php?id=<?php echo $item["id"] ?>">sil</a></td>
                                        <td style="color:black" class="card-header bg-transparent border-success"><?php echo $item['tarih'] ?></td>
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
    </form>

</div>
<script type="text/javascript">
    function tamamla() {
        alert("başarıyla tamamlandı");
    }
</script>
</body>

</html>