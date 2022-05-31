<?php
include "../header.php";
include "../db.php";
include "islem.php";

if ($_POST) {
  echo "sfsdf" . $_POST['baslik'];
}

$sql = $db->query('SELECT satislar.*,musteriler.musteri_adi FROM satislar
LEFT JOIN musteriler ON musteriler.id =satislar.musteri_id')->fetchAll();
if ($_POST) {
  // print_r($_POST);
  $musteri_adi = $_POST["musteri_id"];
  $kullanici_adi = $_POST["kullanici_id"];
  $tarih = $_POST["satis_tarihi"];
  $urun_adi = $_POST["urun_adi"];
  $adet = $_POST["urun_adedi"];
  $fiyat = $_POST["birim_fiyat"];
  //print_r($adet);
  //print_r($fiyat);
  $bos = [];
  for ($i = 0; $i < count($fiyat); $i++) {
    array_push(
      $bos,
      array(
        $urun_adi[$i], $adet[$i], $fiyat[$i]
      )
    );
  }
  print_r($bos);
  foreach ($bos as $value) {
    $sql = $db->prepare('INSERT INTO satislar SET kullanici_id=?,musteri_id=?,satis_tarihi=?,');
    $EKLEYAZ = $sql->execute([$kullanici_adi, $musteri_adi, $tarih,]);
  }
}

?>

<head>
  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

</head>

<body>
  <div class="container  d-block" style="text-align:-webkit-center">
    <?php
    $breadcrumbs = [["link" => "satislar.php", "baslik" => "Satislar"], ["link" => "satis_ekle_form.php", "baslik" => "Satis Ekle"]];
    include "../breadcrumb.php"; ?>
    <form class="w-50 text-center page" method="POST" action="satis_ekle_post.php" id='example'>
      <div class="container col-12  " style="background-color:white;border: 1px solid var(--tblr-border-color);border-radius: 4px;">
        <div class="row">

          <h1 class="text-danger text-center mt-4 font-weight-normal">SATIŞ EKLEMEK İÇİN </h1>
          <p style="color:brown ; text-align:center">Lütfen gerekli belgeleri eksiksiz doldurunuz </p>
          <hr>
          <div class="form-label-group mb-3 text-start mt-3  col-6">
            <p> ŞİRKET ADI * </p>
            <select class="form-select form-control mb-4" name="sirket_adi" id="baslik" aria-label="Default select example">
              <option selected class="text-center">ŞİRKET SEÇİNİZ</option>
              <?php foreach ($db->query("SELECT * from musteriler") as $sirket) { ?>
                <option value="<?php echo $sirket["id"] ?>">
                  <?= $sirket["baslik"] . " " ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-label-group mb-3 text-start mt-3  col-6">
            <p> MÜŞTERİ ADI SOYADI * </p>
            <select class="form-select form-control mb-4" name="musteri_id" id="musteri_adi" aria-label="Default select example">
              <option selected class="text-center">MÜŞTERİ SEÇİNİZ</option>
              <?php foreach ($db->query("SELECT * from musteriler") as $musteri) { ?>

                <option value="<?php echo $musteri["id"] ?>">
                  <?= $musteri["musteri_adi"] . " " ?></option>

              <?php } ?>

            </select>
          </div>
          <div class="form-label-group mb-3 text-start mt-3  col-6">
            <p> SATICI PERSONELİN ADI SOYADI *</p>
            <select class="form-select form-control mb-4" name="kullanici_id" id="kullanici" aria-label="Default select example">
              <option selected class="text-center">PERSONEL SEÇİNİZ</option>
              <?php foreach ($db->query("SELECT * from kullanicilar where role_id=2") as $kullanici) { ?>

                <option value="<?php echo $kullanici["id"] ?>">
                  <?= $kullanici["kullanici_adi"] . " " ?></option>

              <?php } ?>
            </select>
          </div>
          <div class="form-label-group mb-3 text-start mt-3  col-6">
            <p>SATIŞ TARİHİ *</p>
            <input type="date" class="form-control mb-4 text-center" name="satis_tarihi" placeholder="satis_tarihi" required="" autofocus="">
          </div>
          <table data-dynamicrows class="table table-bordered table-striped" style="color: brown;">
            <thead class="mb-3">
              <tr style="text-align: center;" class="mb-3">
                <th>ÜRÜN ADI</th>
                <th>ÜRÜN ADEDİ</th>
                <th>BİRİM FİYATI</th>
                <th>YENİ ÜRÜN EKLE</th>
              </tr>
            </thead>
            <tbody>
              <tr>

                <td><input type="text" name="urun_adi[]" class="form-control"></td>
                <td><input type="text" name="urun_adedi[]" class="form-control"></td>
                <td><input type="text" name="birim_fiyat[]" class="form-control"></td>

                <td>
                  <i class="fa fa-minus del" data-remove></i>
                  <i class="fa fa-arrows" data-move></i>
                  <i class="fa fa-plus add" data-add></i>
                </td>
              </tr>
            </tbody>
          </table>

          <div class="form-label-group mb-4 ml-5 mr-5">
            <p>SATIŞ NOTU *</p>
            <textarea name="satis_not" id="editor1" class="form-control text-center ck_editor mt-3" style="width: 480px;"></textarea>
          </div>
          <div class="form-footer text-center">
            <button type="submit" class="btn btn-primary mb-3">SATIŞ EKLE</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  

  <script>
    $(document).ready(function() {
      $(".ck_editor").each(function(index) {
        var input_name = $(this).attr("name");
        CKEDITOR.replace(input_name);
      });
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="dynamicrows.js"></script>
  <script>
    $(function() {
      $('[data-dynamicrows]').dynamicrows({
        animation: 'fade',
        copyValues: true,
        minrows: 1

      });
    });
  </script>
  <!-- <script>
        $('.sendRequest').click(function() {
          document.getElementById('example').submit();
        })
      </script> -->
  <script>
    $('.add').click(function() {

    })
  </script>
  <script>
    $('.del').click(function(obj) {
      removeRow(this);
    })
  </script>
  <script>
    $('#baslik').on('change', function() {
      var baslik = $('#baslik').val();
      $.ajax({
        'type': 'POST',
        'url': 'islem.php',
        'data': {
          'selected2': baslik,
        },
        'success': function(item) {
          $('#musteri_adi').empty();
          var data = JSON.parse(item);
          console.log(data[0][0].musteri_adi);
          var musteri_id = $('#musteri_adi').val();
          $('#musteri_adi').append(
            `<option value="${data[0].id}">${data[0].musteri_adi}</option>`
          );

        }

      });
      $('#kullanici').val(data[1]['kullanici']);
    });
  </script>

</body>

</html>