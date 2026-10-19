<?php
session_start();
include "koneksi.php";

// Mengecek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Menghitung jumlah pasien
$query_pasien = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pasien");
$data_pasien = mysqli_fetch_assoc($query_pasien);
$total_pasien = $data_pasien['total'];

// Menghitung jumlah dokter
$query_dokter = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM dokter");
$data_dokter = mysqli_fetch_assoc($query_dokter);
$total_dokter = $data_dokter['total'];

// Menghitung jumlah pemeriksaan
$query_pemeriksaan = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pemeriksaan");
$data_pemeriksaan = mysqli_fetch_assoc($query_pemeriksaan);
$total_pemeriksaan = $data_pemeriksaan['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Klinik</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            background-image: url("boneka.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;

        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
            height: 100vh;
            background-color: #1976d2;
            color: white;
            padding: 25px 15px;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo h2 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .logo p {
            font-size: 13px;
            opacity: 0.8;
        }

        .menu-title {
            font-size: 12px;
            margin: 20px 15px 10px;
            opacity: 0.7;
            text-transform: uppercase;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: white;
            padding: 13px 15px;
            margin-bottom: 7px;
            border-radius: 7px;
            font-size: 15px;
        }

        .menu a:hover {
            background-color: #125ca3;
        }

        .menu .active {
            background-color: white;
            color: #1976d2;
        }

        .logout {
            position: absolute;
            bottom: 25px;
            left: 15px;
            right: 15px;
        }

        .logout a {
            display: block;
            text-align: center;
            text-decoration: none;
            background-color: white;
            color: #1976d2;
            padding: 12px;
            border-radius: 7px;
            font-weight: bold;
        }

        .logout a:hover {
            background-color: #eaf4ff;
        }

        /* CONTENT */

        .content {
            margin-left: 240px;
            padding: 30px;
        }

        /* HEADER */

        .header {
            background-color: white;
            padding: 20px 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: #1976d2;
            font-size: 27px;
            margin-bottom: 5px;
        }

        .header p {
            color: #777;
            font-size: 14px;
        }

        .username {
            color: #1976d2;
            font-weight: bold;
        }

        /* CARDS */

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .card h3 {
            font-size: 15px;
            color: #777;
            margin-bottom: 12px;
        }

        .number {
            font-size: 35px;
            font-weight: bold;
            color: #1976d2;
        }

        /* WELCOME */

        .welcome {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .welcome h2 {
            color: #1976d2;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #666;
            line-height: 1.6;
        }

        /* RESPONSIVE */

        @media (max-width: 800px) {

            .sidebar {
                width: 190px;
            }

            .content {
                margin-left: 190px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .header {
                display: block;
            }

        }

        .lokasi {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .lokasi h3 {
            color: #1976d2;
            font-size: 22px;
            margin-bottom: 5px;
        }

        .lokasi p {
            color: #666;
            font-size: 15px;
            margin-bottom: 12px;
        }

        .lokasi iframe {
             width: 500px;
            height: 220px;
            max-width: 100%;
            border-radius: 8px;
        }

    </style>
</head>
<body>

    <audio id="musik" autoplay loop>
        <source src="musik/Everytime - CHEN  Punch (320).mp3" type="audio/mpeg">
    </audio>

    <script>
        const musik = document.getElementById("musik");

        // Mengambil posisi lagu terakhir
        const posisiTerakhir = localStorage.getItem("posisiMusik");

        if (posisiTerakhir) {
          musik.currentTime = parseFloat(posisiTerakhir);
        }

        // Menyimpan posisi lagu setiap saat
        musik.addEventListener("timeupdate", function() {
            localStorage.setItem("posisiMusik", musik.currentTime);
         });

        // Memutar musik
        musik.play().catch(function() {
            console.log("Musik menunggu izin browser.");
        });
    </script>

    <!-- SIDEBAR --> 
    <div class="sidebar">
        <div class="logo">
            <h2>KLINIK WULAN</h2>
            <p> Sistem Informasi Klinik</p>
        </div>
        <div class="menu">
            <div class="menu-title">
                Menu Utama
            </div>
            <a href="dashboard.php" class="active">
                Dashboard
                
            </a>
            <a href="pasien/index.php">
                👤 Data Pasien
            </a>
            <a href="dokter/index.php">
                👨‍⚕️ Data Dokter
            </a>
            <a href="pemeriksaan/index.php">
                🩺 Data Pemeriksaan
            </a>
        </div>
        
        <div class="logout">
            <a href="logout.php">
                Logout
            </a>
        </div>
    </div>

        <!-- CONTENT -->
    <div class="content">

        <!-- HEADER -->
        <div class="header">
            <div>
                <h1>Dashboard</h1>
                <p>
                    Selamat datang di Sistem Informasi Klinik
                </p>
            </div>
            <div>
                User:
                <span class="username">
                    <?php echo $_SESSION['username']; ?>
                </span>
            </div>
        </div>

         <!-- CARDS -->
        <div class="cards">
            <div class="card">
                <h3>👤 Total Pasien</h3>
                <div class="number">
                    <?php echo $total_pasien; ?>
                </div>
            </div>
            <div class="card">
                <h3>👨‍⚕️ Total Dokter</h3>
                <div class="number">
                    <?php echo $total_dokter; ?>
                </div>
            </div>
            <div class="card">
                <h3>🩺 Total Pemeriksaan</h3>
                <div class="number">
                    <?php echo $total_pemeriksaan; ?>
                </div>
                </div>
            </div>

        <div class="welcome">
            <h2>Sistem Informasi Klinik</h2>
            <p>
                Dashboard ini digunakan untuk mengelola informasi data pasien, dokter, dan pemeriksaan pada klinik. Gunakan menu di sebelah kiri untuk mengakses data yang diperlukan.
            </p>
        </div>
        <div class="lokasi">
            <h3>Lokasi Klinik</h3>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.5530668811707!2d114.8166874!3d-3.4582181000000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de6815c7365c8c3%3A0xc715acc03ac8135c!2sRSU%20Syifa%20Medika%20Banjarbaru!5e0!3m2!1sid!2sid!4v1789839348040!5m2!1sid!2sid"
            width="500"
            height="220"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>
    </div>
</div>
</body>
</html>