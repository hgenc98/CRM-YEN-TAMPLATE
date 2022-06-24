<?php
include "db.php";
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CRM</title>
    <link href="/crm-yeni/dist/css/tabler.min.css" rel="stylesheet" />
    <link href="/crm-yeni/dist/css/tabler-flags.min.css" rel="stylesheet" />
    <link href="/crm-yeni/dist/css/tabler-payments.min.css" rel="stylesheet" />
    <link href="/crm-yeni/dist/css/tabler-vendors.min.css" rel="stylesheet" />
    <link href="/crm-yeni/dist/css/demo.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="ziyaret.css">
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container-fluid">
        <header class="navbar navbar-expand-md d-print-none text-center" style="border-bottom: 1px solid rgba(9, 30, 66, 0.13);">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="/crm-yeni/anasayfa.php">
                        <img src="/crm-yeni/img/logom.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                    </a>
                </h1>
                <div class="container-fluid">
                        <ul class="navbar-nav d-flex justify-content-center">
                            <li class="nav-item ">
                                <a class="nav-link" href="/crm-yeni/anasayfa.php">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="header.php" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        ANASAYFA
                                    </span>
                                </a>
                            </li>
                            <?php
                            $rol = $_SESSION['rol'];
                            if ($rol == 1) { ?>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <desc>Download more icon variants from https://tabler-icons.io/i/users</desc>
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="9" cy="7" r="4"></circle>
                                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                            </svg>

                                        </span>
                                        <span class="nav-link-title">
                                            KULLANICI
                                        </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                <a class="dropdown-item" href="/crm-yeni/kullanici_icerik/kullanici.php">
                                                    KULLANICILAR
                                                </a>


                                            </div>
                                        </div>
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                <a class="dropdown-item" href="/crm-yeni/kullanici_icerik/kullanici_subeler.php">
                                                    KULLANICI ŞUBELERİ
                                                </a>


                                            </div>
                                        </div>
                                    </div>

                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <desc>Download more icon variants from https://tabler-icons.io/i/user</desc>
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            MÜŞTERİLER
                                        </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                <a class="dropdown-item" href="/crm-yeni/musteri_icerik/musteriler.php">
                                                    MÜŞTERİLER
                                                </a>


                                            </div>
                                        </div>
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                <a class="dropdown-item" href="/crm-yeni/musteri_icerik/musteri_eleman.php">
                                                    MÜŞTERİ ELEMANI
                                                </a>


                                            </div>
                                        </div>
                                    </div>

                                </li>
                            <?php } ?>
                            <?php
                            $rol = $_SESSION['rol'];
                            if ($rol == 1 || $rol == 2) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/crm-yeni/satis_icerik/satislar.php">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                                            <svg xmlns="/crm-yeni/satis_icerik/satislar.php" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                <line x1="9" y1="9" x2="10" y2="9" />
                                                <line x1="9" y1="13" x2="15" y2="13" />
                                                <line x1="9" y1="17" x2="15" y2="17" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            SATIŞ
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/crm-yeni/ziyaret_icerik/ziyaret.php">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                                            <svg xmlns="/crm-yeni/ziyaret_icerik/ziyaret.php" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                <line x1="9" y1="9" x2="10" y2="9" />
                                                <line x1="9" y1="13" x2="15" y2="13" />
                                                <line x1="9" y1="17" x2="15" y2="17" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            ZİYARETLER
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>

                    </div>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm" style="background-image: url(/crm-yeni/img/ben.jpg)"></span>
                            <div class="d-none d-xl-block ps-3">
                                <h5 class="col" style="color: black;"><strong><?php echo $_SESSION['adi']; ?></strong></h5>
                                <div class="mt-1 small text-muted"><?php echo $_SESSION['e_posta']; ?></div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        
                            <a href="/crm-yeni/admin.php" class="dropdown-item">ÇIKIŞ YAP</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
       
</body>

</html>

<script src="../dist/js/tabler.min.js"></script>
<script src="../dist/js/demo.min.js"></script>