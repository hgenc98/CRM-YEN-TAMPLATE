<?php
require 'vendor/autoload.php';

use Carbon\Carbon;


include "db.php";
include "header.php";


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
<div class="page-wrapper">
    <div class="container-xl">
        <!-- Page title -->

        <div class="d-print-none mt-3">
            <div class="row ">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        <?php include "breadcrumb.php"; ?>
                    </div>
                    <!-- <h2 class="page-title">
                        Anasayfa
                    </h2> -->
                </div>
                <!-- Page title actions -->
                <div class="col-sm-6 col-lg-3">
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

            </div>
        </div>
    </div>
    <?php
    $rol = $_SESSION['rol'];
    if ($rol == 1) { ?>
        <div class="page-body">
            <div class="container">
                <div class="row row-deck row-cards">

                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class=" text-center">
                                    <div class="subheader">
                                        <h2> Müşterilerimiz </h2>
                                    </div>
                                    <hr>
                                </div>
                                <div class="h1 mb-3 text-center"><?php $musteri_sayac = $db->query('SELECT COUNT(*) as sayac FROM musteriler where musteriler.firma_id = ' . $_SESSION["firma_id"] . '')->fetch();
                                                                    echo ($musteri_sayac["sayac"]);
                                                                    ?>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="subheader">
                                        <h2>ZİYARETLERİMİZ</h2>
                                    </div>
                                </div>
                                <hr>

                                <div class="h1 mb-0 me-2 text-center">
                                    <?php $musteri_sayac_2 = $db->query('SELECT COUNT(*) as sayac FROM ziyaretler where ziyaretler.firma_id = ' . $_SESSION["firma_id"] . '')->fetch();
                                    echo ($musteri_sayac_2["sayac"]);
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="subheader">
                                        <h2>SATIŞLARIMIZ</h2>
                                    </div>
                                </div>
                                <hr>

                                <div class="h1 mb-0 me-2 text-center">
                                    <?php $musteri_sayac_3 = $db->query('SELECT COUNT(*) as sayac FROM satislar where satislar.firma_id = ' . $_SESSION["firma_id"] . '')->fetch();
                                    echo ($musteri_sayac_3["sayac"]);
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>




                <?php } ?>
                <div class="card mt-5">
                    <div>
                        <h5 class="mt-3 " style="color:red;text-align: center;">ANASAYFA YAPILMIŞ VEYA YAPILACAK ZİYARET BİLGİLERİ</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        </th>
                                        <th>GÖREVLİ</th>
                                        <th>MÜŞTERİLER</th>
                                        <th>ELEMANLAR</th>
                                        <th>MÜŞTERİ ADRESİ</th>
                                        <th>MÜŞTERİ TELEFON</th>
                                        <th>TAMAMLANACAK TARİH</th>
                                        <th>AÇIKLAMA</th>
                                        <th>TAMAMLANDI</th>
                                        <?php $rol = $_SESSION['rol'];
                                        if ($rol == 1) { ?>
                                            <th>TAMAMLANAN TARİH</th>
                                            <th>DÜZENLE</th>
                                            <th>SİL</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($sql) > 0) {
                                        foreach ($sql as $item) {

                                    ?>
                                            <tr>
                                                <td style="color:black"><?php echo $item['tamamlayan_adi'] ?></td>
                                                <td style="color:black"><?php echo $item['musteri_adi'] ?></td>
                                                <td style="color:black"><?php echo $item['eleman_adi'] ?></td>
                                                <td style="color:black"><?php echo $item['musteri_adres'] ?></td>
                                                <td style="color:black"><?php echo $item['tel_no'] ?></td>
                                                <td style="color:black"><?php echo (new DateTime($item['tamamlanacak_tarih']))->format("d/m/y h:i:s") ?></td>
                                                <td style="color:black"><?php echo $item['aciklama'] ?></td>

                                                <?php $rol = $_SESSION['rol'];
                                                if ($rol == 1) { ?>
                                                    <form action="" method="POST">
                                                        <input type="hidden" name='id' value="<?php echo $item['id'] ?>">

                                                        <td style="text-align: center;">
                                                            <?php if ($item['durum'] == 1) {
                                                            ?>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <desc>Download more icon variants from https://tabler-icons.io/i/checks</desc>
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M7 12l5 5l10 -10"></path>
                                                                    <path d="M2 12l5 5m5 -5l5 -5"></path>
                                                                </svg><?php
                                                                    } else { ?>
                                                                <strong><i style="color: red;" class="fa-thin fa-x"></i></strong>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="color:black" class="card-header "><?php echo (new DateTime($item['tarih']))->format("d/m/y h:i:s") ?></td>

                                                    </form>
                                                <?php }
                                                ?>
                                                <?php $rol = $_SESSION['rol'];
                                                if ($rol == 2) { ?>
                                                    <form action="" method="POST">
                                                        <input type="hidden" name='id' value="<?php echo $item['id'] ?>">

                                                        <td style="text-align: center;" class=" card-header ">
                                                            <?php if ($item['durum'] == 1) {
                                                            ?>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <desc>Download more icon variants from https://tabler-icons.io/i/checks</desc>
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M7 12l5 5l10 -10"></path>
                                                                    <path d="M2 12l5 5m5 -5l5 -5"></path>
                                                                </svg><?php
                                                                    } else { ?>
                                                                <strong> <i style="color: black;" class="fa-thin fa-x"></i></strong>
                                                            <?php } ?>
                                                        </td>
                                                    </form>
                                                <?php }
                                                ?>
                                                <?php $rol = $_SESSION['rol'];
                                                if ($rol == 1) { ?>
                                                    <td style="color:black;">
                                                        <a class="btn btn-primary" href="ziyaret_icerik/ziyaret_duzenle_form.php?id=<?php echo $item["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <desc>Download more icon variants from https://tabler-icons.io/i/file-pencil</desc>
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                                <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
                                                            </svg>
                                                        </a>
                                                    </td>
                                                    <td style="color:black;">
                                                        <a class="btn btn-danger" style="color: black !important;" href="ziyaret_icerik/ziyaret_sil.php?id=<?php echo $item["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <desc>Download more icon variants from https://tabler-icons.io/i/trash</desc>
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <line x1="4" y1="7" x2="20" y2="7"></line>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg></a>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
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
                                            </svg> Sponsor
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                                <ul class="list-inline list-inline-dots mb-0">
                                    <li class="list-inline-item">
                                        Copyright &copy; 2022
                                        <a href="." class="link-secondary">Tabler</a>. All rights reserved.
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
                                <h5 class="modal-title">New report</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="example-text-input" placeholder="Your report name">
                                </div>
                                <label class="form-label">Report type</label>
                                <div class="form-selectgroup-boxes row mb-3">
                                    <div class="col-lg-6">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="report-type" value="1" class="form-selectgroup-input" checked>
                                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                <span class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </span>
                                                <span class="form-selectgroup-label-content">
                                                    <span class="form-selectgroup-title strong mb-1">Simple</span>
                                                    <span class="d-block text-muted">Provide only basic data needed for the report</span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="report-type" value="1" class="form-selectgroup-input">
                                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                <span class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </span>
                                                <span class="form-selectgroup-label-content">
                                                    <span class="form-selectgroup-title strong mb-1">Advanced</span>
                                                    <span class="d-block text-muted">Insert charts and additional advanced analyses to be inserted in the report</span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label class="form-label">Report url</label>
                                            <div class="input-group input-group-flat">
                                                <span class="input-group-text">
                                                    https://tabler.io/reports/
                                                </span>
                                                <input type="text" class="form-control ps-0" value="report-01" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Visibility</label>
                                            <select class="form-select">
                                                <option value="1" selected>Private</option>
                                                <option value="2">Public</option>
                                                <option value="3">Hidden</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Client name</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Reporting period</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div>
                                            <label class="form-label">Additional information</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </a>
                                <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Create new report
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Libs JS -->
                <script src="./dist/libs/apexcharts/dist/apexcharts.min.js"></script>
                <!-- Tabler Core -->
                <script src="./dist/js/tabler.min.js"></script>
                <script src="./dist/js/demo.min.js"></script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
                            chart: {
                                type: "area",
                                fontFamily: 'inherit',
                                height: 40.0,
                                sparkline: {
                                    enabled: true
                                },
                                animations: {
                                    enabled: false
                                },
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            fill: {
                                opacity: .16,
                                type: 'solid'
                            },
                            stroke: {
                                width: 2,
                                lineCap: "round",
                                curve: "smooth",
                            },
                            series: [{
                                name: "Profits",
                                data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
                            }],
                            grid: {
                                strokeDashArray: 4,
                            },
                            xaxis: {
                                labels: {
                                    padding: 0,
                                },
                                tooltip: {
                                    enabled: false
                                },
                                axisBorder: {
                                    show: false,
                                },
                                type: 'datetime',
                            },
                            yaxis: {
                                labels: {
                                    padding: 4
                                },
                            },
                            labels: [
                                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                            ],
                            colors: ["#206bc4"],
                            legend: {
                                show: false,
                            },
                        })).render();
                    });
                    // @formatter:on
                </script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-clients'), {
                            chart: {
                                type: "line",
                                fontFamily: 'inherit',
                                height: 40.0,
                                sparkline: {
                                    enabled: true
                                },
                                animations: {
                                    enabled: false
                                },
                            },
                            fill: {
                                opacity: 1,
                            },
                            stroke: {
                                width: [2, 1],
                                dashArray: [0, 3],
                                lineCap: "round",
                                curve: "smooth",
                            },
                            series: [{
                                name: "May",
                                data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 4, 46, 39, 62, 51, 35, 41, 67]
                            }, {
                                name: "April",
                                data: [93, 54, 51, 24, 35, 35, 31, 67, 19, 43, 28, 36, 62, 61, 27, 39, 35, 41, 27, 35, 51, 46, 62, 37, 44, 53, 41, 65, 39, 37]
                            }],
                            grid: {
                                strokeDashArray: 4,
                            },
                            xaxis: {
                                labels: {
                                    padding: 0,
                                },
                                tooltip: {
                                    enabled: false
                                },
                                type: 'datetime',
                            },
                            yaxis: {
                                labels: {
                                    padding: 4
                                },
                            },
                            labels: [
                                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                            ],
                            colors: ["#206bc4", "#a8aeb7"],
                            legend: {
                                show: false,
                            },
                        })).render();
                    });
                    // @formatter:on
                </script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('chart-active-users'), {
                            chart: {
                                type: "bar",
                                fontFamily: 'inherit',
                                height: 40.0,
                                sparkline: {
                                    enabled: true
                                },
                                animations: {
                                    enabled: false
                                },
                            },
                            plotOptions: {
                                bar: {
                                    columnWidth: '50%',
                                }
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            fill: {
                                opacity: 1,
                            },
                            series: [{
                                name: "Profits",
                                data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
                            }],
                            grid: {
                                strokeDashArray: 4,
                            },
                            xaxis: {
                                labels: {
                                    padding: 0,
                                },
                                tooltip: {
                                    enabled: false
                                },
                                axisBorder: {
                                    show: false,
                                },
                                type: 'datetime',
                            },
                            yaxis: {
                                labels: {
                                    padding: 4
                                },
                            },
                            labels: [
                                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                            ],
                            colors: ["#206bc4"],
                            legend: {
                                show: false,
                            },
                        })).render();
                    });
                    // @formatter:on
                </script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
                            chart: {
                                type: "bar",
                                fontFamily: 'inherit',
                                height: 240,
                                parentHeightOffset: 0,
                                toolbar: {
                                    show: false,
                                },
                                animations: {
                                    enabled: false
                                },
                                stacked: true,
                            },
                            plotOptions: {
                                bar: {
                                    columnWidth: '50%',
                                }
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            fill: {
                                opacity: 1,
                            },
                            series: [{
                                name: "Web",
                                data: [1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 2, 12, 5, 8, 22, 6, 8, 6, 4, 1, 8, 24, 29, 51, 40, 47, 23, 26, 50, 26, 41, 22, 46, 47, 81, 46, 6]
                            }, {
                                name: "Social",
                                data: [2, 5, 4, 3, 3, 1, 4, 7, 5, 1, 2, 5, 3, 2, 6, 7, 7, 1, 5, 5, 2, 12, 4, 6, 18, 3, 5, 2, 13, 15, 20, 47, 18, 15, 11, 10, 0]
                            }, {
                                name: "Other",
                                data: [2, 9, 1, 7, 8, 3, 6, 5, 5, 4, 6, 4, 1, 9, 3, 6, 7, 5, 2, 8, 4, 9, 1, 2, 6, 7, 5, 1, 8, 3, 2, 3, 4, 9, 7, 1, 6]
                            }],
                            grid: {
                                padding: {
                                    top: -20,
                                    right: 0,
                                    left: -4,
                                    bottom: -4
                                },
                                strokeDashArray: 4,
                                xaxis: {
                                    lines: {
                                        show: true
                                    }
                                },
                            },
                            xaxis: {
                                labels: {
                                    padding: 0,
                                },
                                tooltip: {
                                    enabled: false
                                },
                                axisBorder: {
                                    show: false,
                                },
                                type: 'datetime',
                            },
                            yaxis: {
                                labels: {
                                    padding: 4
                                },
                            },
                            labels: [
                                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19', '2020-07-20', '2020-07-21', '2020-07-22', '2020-07-23', '2020-07-24', '2020-07-25', '2020-07-26'
                            ],
                            colors: ["#206bc4", "#79a6dc", "#bfe399"],
                            legend: {
                                show: false,
                            },
                        })).render();
                    });
                    // @formatter:on
                </script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-activity'), {
                            chart: {
                                type: "radialBar",
                                fontFamily: 'inherit',
                                height: 40,
                                width: 40,
                                animations: {
                                    enabled: false
                                },
                                sparkline: {
                                    enabled: true
                                },
                            },
                            tooltip: {
                                enabled: false,
                            },
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        margin: 0,
                                        size: '75%'
                                    },
                                    track: {
                                        margin: 0
                                    },
                                    dataLabels: {
                                        show: false
                                    }
                                }
                            },
                            colors: ["#206bc4"],
                            series: [35],
                        })).render();
                    });
                    // @formatter:on
                </script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('chart-development-activity'), {
                            chart: {
                                type: "area",
                                fontFamily: 'inherit',
                                height: 192,
                                sparkline: {
                                    enabled: true
                                },
                                animations: {
                                    enabled: false
                                },
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            fill: {
                                opacity: .16,
                                type: 'solid'
                            },
                            stroke: {
                                width: 2,
                                lineCap: "round",
                                curve: "smooth",
                            },
                            series: [{
                                name: "Purchases",
                                data: [3, 5, 4, 6, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 8, 4, 14, 30, 17, 19, 15, 14, 25, 32, 40, 55, 60, 48, 52, 70]
                            }],
                            grid: {
                                strokeDashArray: 4,
                            },
                            xaxis: {
                                labels: {
                                    padding: 0,
                                },
                                tooltip: {
                                    enabled: false
                                },
                                axisBorder: {
                                    show: false,
                                },
                                type: 'datetime',
                            },
                            yaxis: {
                                labels: {
                                    padding: 4
                                },
                            },
                            labels: [
                                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                            ],
                            colors: ["#206bc4"],
                            legend: {
                                show: false,
                            },
                            point: {
                                show: false
                            },
                        })).render();
                    });
                    // @formatter:on
                </script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-1'), {
                            chart: {
                                type: "line",
                                fontFamily: 'inherit',
                                height: 24,
                                animations: {
                                    enabled: false
                                },
                                sparkline: {
                                    enabled: true
                                },
                            },
                            tooltip: {
                                enabled: false,
                            },
                            stroke: {
                                width: 2,
                                lineCap: "round",
                            },
                            series: [{
                                color: "#206bc4",
                                data: [17, 24, 20, 10, 5, 1, 4, 18, 13]
                            }],
                        })).render();
                    });
                    // @formatter:on
                </script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-2'), {
                            chart: {
                                type: "line",
                                fontFamily: 'inherit',
                                height: 24,
                                animations: {
                                    enabled: false
                                },
                                sparkline: {
                                    enabled: true
                                },
                            },
                            tooltip: {
                                enabled: false,
                            },
                            stroke: {
                                width: 2,
                                lineCap: "round",
                            },
                            series: [{
                                color: "#206bc4",
                                data: [13, 11, 19, 22, 12, 7, 14, 3, 21]
                            }],
                        })).render();
                    });
                    // @formatter:on
                </script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-3'), {
                            chart: {
                                type: "line",
                                fontFamily: 'inherit',
                                height: 24,
                                animations: {
                                    enabled: false
                                },
                                sparkline: {
                                    enabled: true
                                },
                            },
                            tooltip: {
                                enabled: false,
                            },
                            stroke: {
                                width: 2,
                                lineCap: "round",
                            },
                            series: [{
                                color: "#206bc4",
                                data: [10, 13, 10, 4, 17, 3, 23, 22, 19]
                            }],
                        })).render();
                    });
                    // @formatter:on
                </script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-4'), {
                            chart: {
                                type: "line",
                                fontFamily: 'inherit',
                                height: 24,
                                animations: {
                                    enabled: false
                                },
                                sparkline: {
                                    enabled: true
                                },
                            },
                            tooltip: {
                                enabled: false,
                            },
                            stroke: {
                                width: 2,
                                lineCap: "round",
                            },
                            series: [{
                                color: "#206bc4",
                                data: [6, 15, 13, 13, 5, 7, 17, 20, 19]
                            }],
                        })).render();
                    });
                    // @formatter:on
                </script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-5'), {
                            chart: {
                                type: "line",
                                fontFamily: 'inherit',
                                height: 24,
                                animations: {
                                    enabled: false
                                },
                                sparkline: {
                                    enabled: true
                                },
                            },
                            tooltip: {
                                enabled: false,
                            },
                            stroke: {
                                width: 2,
                                lineCap: "round",
                            },
                            series: [{
                                color: "#206bc4",
                                data: [2, 11, 15, 14, 21, 20, 8, 23, 18, 14]
                            }],
                        })).render();
                    });
                    // @formatter:on
                </script>
                <script>
                    // @formatter:off
                    document.addEventListener("DOMContentLoaded", function() {
                        window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-6'), {
                            chart: {
                                type: "line",
                                fontFamily: 'inherit',
                                height: 24,
                                animations: {
                                    enabled: false
                                },
                                sparkline: {
                                    enabled: true
                                },
                            },
                            tooltip: {
                                enabled: false,
                            },
                            stroke: {
                                width: 2,
                                lineCap: "round",
                            },
                            series: [{
                                color: "#206bc4",
                                data: [22, 12, 7, 14, 3, 21, 8, 23, 18, 14]
                            }],
                        })).render();
                    });
                    // @formatter:on
                </script>
                </body>