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
require 'vendor/autoload.php';

use Carbon\Carbon;


if (!isset($_SESSION["login"])) {
    header("LOCATION:giris.php");
}
include "db.php";
include "index.php";

$sql = $db->query('SELECT kullanicilar.*,roller.role_adi ,kullanici_subeler.sube_adi FROM kullanicilar
LEFT JOIN roller ON roller.id =kullanicilar.role_id
LEFT JOIN kullanici_subeler ON kullanici_subeler.id =kullanicilar.sube_id
where kullanicilar.firma_id = ' . $_SESSION["firma_id"] . '
');
?>
<div class="page-wrapper">
  <div class="container-xl">
    <div class="d-print-none mt-3">
      <div class="row ">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            <?php
            $breadcrumbs = [["link" => "kullanici_icerik/kullanici.php", "baslik" => "Kullanici"]];
            include "breadcrumb.php"; ?>
          </div>
          <!-- <h2 class="page-title">
                        Anasayfa
                    </h2> -->
        </div>

        <?php
        $rol = $_SESSION['rol'];
        if ($rol == 1) { ?>
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">

              <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <line x1="12" y1="5" x2="12" y2="19" />
                  <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                KULLANICI EKLE
              </a>
              <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <line x1="12" y1="5" x2="12" y2="19" />
                  <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
              </a>
            </div>
          </div>
      </div>

    <?php }  ?>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">

          <div class="subheader">
            <?php $sql1 = $db->query('SELECT * FROM firma  where id = ' . $_SESSION["firma_id"] . '')->fetchAll();
            // echo $sql['sozlesme_yili'];
            foreach ($sql1 as $item) {

              echo "Başlangıç Tarihi : " . (new DateTime($item['sozlesme_baslangic']))->format("d/m/Y h:i:s");
            ?>
              <br>
              <br>
            <?php
              $date = Carbon::parse($item['sozlesme_baslangic'])->addDay(30)->format("d/m/Y h:i:s");
              echo "Bitiş Tarihi : " . $date;
            }

            ?>
          </div>


        </div>
      </div>
    </div>
    <footer class="footer footer-transparent d-print-none">
      <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
          <div class="col-lg-auto ms-lg-auto">
            <ul class="list-inline list-inline-dots mb-0">
              <li class="list-inline-item"><a href="./docs/index.html" class="link-secondary">Documentation</a></li>
              <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li>
              <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary" rel="noopener">Source code</a></li>
              <li class="list-inline-item">
                <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary" rel="noopener">
                  <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                  </svg>
                  Sponsor
                </a>
              </li>
            </ul>
          </div>
          <div class="col-12 col-lg-auto mt-3 mt-lg-0">
            <ul class="list-inline list-inline-dots mb-0">
              <li class="list-inline-item">
                Copyright &copy; 2022
                <a href="." class="link-secondary">Tabler</a>.
                All rights reserved.
              </li>
              <li class="list-inline-item">
                <a href="./changelog.html" class="link-secondary" rel="noopener">
                  v1.0.0-beta5
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">YENİ KAYIT</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">ADI VE SOYADI *</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="AD VE SOYAD">
            </div>
            <div class="mb-3">
              <label class="form-label">E Mail *</label>
              <input type="email" class="form-control" name="example-text-input" placeholder="MAİL ADRESİ">
            </div>
            <div class="form-label">
              ŞİFRE *
              <input type="pasword" class="form-control" name="sifre" placeholder="sifre" required="">
            </div>
            <div class="form-label">
              KULLANICI TELEFONU *
              <input type="number" class="form-control" name="tel" placeholder="tel" required="">
            </div>
            <div class="ml-5 mr-5">
              ROL SEÇİNİZ *
              <select class="form-select form-control " name="role_id" aria-label="Default select example">
                <option selected>ROL SEÇİNİZ</option>
                <?php foreach ($db->query("SELECT * from roller") as $roller) { ?>

                  <option value="<?php echo $roller["id"] ?>">
                    <?= $roller["role_adi"] . " " ?></option>

                <?php } ?>
              </select>
            </div>
            <div class="mt-4 ml-5 mr-5">
              ŞUBE SEÇİNİZ *
              <select class="form-select" name="sube_id" aria-label="Default select example">
                <option selected>ŞUBE SEÇİNİZ</option>
                <?php foreach ($db->query("SELECT * from kullanici_subeler") as $subeler) { ?>

                  <option value="<?= $subeler["id"] ?>">
                    <?= $subeler["sube_adi"] . " " ?></option>

                <?php } ?>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
    <script src="./dist/js/demo.min.js"></script>
    </body>

    </html>