<?php
include "../koneksi.php";

// Mengambil semua data pasien
$query = mysqli_query($koneksi, "SELECT * FROM pasien");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien - Klinik Wulan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            background-image: url("../boneka.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .header {
            background-color: #1976d2;
            color: white;
            padding: 20px 25px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .header h1 {
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
        }

        .button {
            display: inline-block;
            background-color: #1976d2;
            color: white;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .button:hover {
            background-color: #125ca3;
        }

        .table-box {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #1976d2;
            color: white;
            padding: 13px;
            text-align: left;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f9ff;
        }

        

        .kembali {
            display: inline-block;
            margin-top: 20px;
            color: #1976d2;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Data Pasien</h1>
        <p>Kelola data pasien Klinik Wulan</p>
    </div>

    <a href="tambah.php" class="button">+ Tambah Pasien</a>

    <div class="table-box">

        <table>

            <tr>
                <th>ID Pasien</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Tools</th>
            </tr>

            <?php while ($data = mysqli_fetch_assoc($query)) { ?>

            <tr>

                <td><?php echo $data['id_pasien']; ?></td>

                <td><?php echo $data['nama_pasien']; ?></td>

                <td><?php echo $data['jenis_kelamin']; ?></td>

                <td><?php echo $data['tanggal_lahir']; ?></td>

                <td><?php echo $data['alamat']; ?></td>

                <td><?php echo $data['no_hp']; ?></td>

                <td>
                    <a href="edit.php?id=<?php echo $data['id_pasien']; ?>" class="edit">
                        Edit.
                    </a>

                    <a href="hapus.php?id=<?php echo $data['id_pasien']; ?>"
                       class="hapus"
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