<?php

include "../koneksi.php";

$query = mysqli_query(
    $koneksi,
    "SELECT pemeriksaan.*,
            pasien.nama_pasien,
            dokter.nama_dokter
     FROM pemeriksaan
     JOIN pasien ON pemeriksaan.id_pasien = pasien.id_pasien
     JOIN dokter ON pemeriksaan.id_dokter = dokter.id_dokter"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Data Pemeriksaan</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
            background-image: url("../boneka.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .container {
            width: 100%;
            max-width: 1450px;
            margin: auto;
        }

        .judul {
            background-color: #1976d2;
            color: white;
            padding: 25px 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .judul h2 {
            margin: 0;
            font-size: 36px;
        }

        .judul p {
            margin: 5px 0 0;
            font-size: 18px;
        }

        .tambah {
            display: inline-block;
            background-color: #1976d2;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 18px;
        }

        .tambah:hover {
            background-color: #125ca3;
        }

        .kotak-tabel {
            background-color: white;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.15);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1150px;
        }

        th {
            background-color: #1976d2;
            color: white;
            padding: 15px;
            text-align: left;
            white-space: nowrap;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .kembali {
            display: block;
            margin-top: 25px;
            color: #1976d2;
            text-decoration: none;
            font-size: 18px;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="judul">
        <h2>Data Pemeriksaan</h2>
        <p>Kelola data pemeriksaan Klinik Wulan</p>
    </div>
    <a href="tambah.php" class="tambah">
        + Tambah Pemeriksaan
    </a>
    <div class="kotak-tabel">
        <table>
            <tr>
                <th>ID Pemeriksaan</th>
                <th>Nama Pasien</th>
                <th>Nama Dokter</th>
                <th>Tanggal</th>
                <th>Keluhan</th>
                <th>Diagnosa</th>
                <th>Jenis Pembayaran</th>
                <th>Total Biaya</th>
                <th>Tools</th>
            </tr>

            <?php while ($data = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td>
                    <?php echo $data['id_pemeriksaan']; ?>
                </td>
                <td>
                    <?php echo $data['nama_pasien']; ?>
                </td>
                <td>
                    <?php echo $data['nama_dokter']; ?>
                </td>
                <td>
                    <?php echo $data['tanggal']; ?>
                </td>
                <td>
                    <?php echo $data['keluhan']; ?>
                </td>
                <td>
                    <?php echo $data['diagnosa']; ?>
                </td>

                <td>
                    <?php echo $data['jenis_pembayaran']; ?>
                </td>

                <td>
                    <?php
                    if ($data['jenis_pembayaran'] == 'BPJS') {
                         echo "Ditanggung BPJS";
                    } else {
                        echo "Rp " . number_format($data['total_biaya'], 0, ',', '.');
                    }
                    ?>
                </td>

                <!-- KOLOM TOOLS -->
                <td>
                    <a href="edit.php?id=<?php echo $data['id_pemeriksaan']; ?>">
                        Edit
                    </a> | 
                    <a href="hapus.php?id=<?php echo $data['id_pemeriksaan']; ?>"
                        onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?');">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <a href="../dashboard.php" class="kembali">
        Kembali ke Dashboard
    </a>
</div>
</body>
</html>