<?php

include_once "../koneksi.php";

// SKRIP TOMBOL SIMPAN DIKLIK

if (isset($_POST['btnSimpan'])) {

    $nama_pasien = $_POST['nama_pasien'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    // Validasi Form Input
    $pesanError = array();

    if (trim($nama_pasien) == "") {
        $pesanError[] = "Data <b>NAMA PASIEN</b> tidak boleh kosong!";
    }

    if (trim($tanggal_lahir) == "") {
        $pesanError[] = "Data <b>TANGGAL LAHIR</b> tidak boleh kosong!";
    }

    if (trim($jenis_kelamin) == "") {
        $pesanError[] = "Data <b>JENIS KELAMIN</b> tidak boleh kosong!";
    }

    if (trim($no_hp) == "") {
        $pesanError[] = "Data <b>NO HP</b> tidak boleh kosong!";
    }

    if (trim($alamat) == "") {
        $pesanError[] = "Data <b>ALAMAT</b> tidak boleh kosong!";
    }

    if (count($pesanError) >= 1) {

        $noPesan = 0;

        foreach ($pesanError as $indeks => $pesan_tampil) {

            $noPesan++;

            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }

        echo "<br>";

    } else {

        // Simpan data pasien

        $sqlSimpan = mysqli_query(
            $koneksi,
            "INSERT INTO pasien
            (nama_pasien, tanggal_lahir, jenis_kelamin, no_hp, alamat)
            VALUES
            ('$nama_pasien', '$tanggal_lahir', '$jenis_kelamin', '$no_hp', '$alamat')"
        );

        if ($sqlSimpan) {

            echo "
            <center>
                <b>
                    <font color='green' size='4'>
                        <p>Data Berhasil Disimpan</p>
                    </font>
                </b>
            </center>

            <meta http-equiv='refresh' content='2; url=index.php'>
            ";

        } else {

            echo "
            <center>
                <b>
                    <font color='red' size='4'>
                        <p>Data Gagal Disimpan!</p>
                    </font>
                </b>
            </center>
            ";
        }

        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Pasien</title>
</head>

<body>

    <form action="tambah.php" method="post">

        <h2>Tambah Data Pasien</h2>

        <table cellpadding="6">

            <tr>
                <td>Nama Pasien</td>
                <td>:</td>
                <td>
                    <input
                        type="text"
                        name="nama_pasien"
                        size="30"
                        maxlength="100"
                    >
                </td>
            </tr>

            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td>
                    <input
                        type="date"
                        name="tanggal_lahir"
                    >
                </td>
            </tr>

            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>
                    <input
                        type="radio"
                        name="jenis_kelamin"
                        value="Perempuan"
                    > Perempuan

                    <input
                        type="radio"
                        name="jenis_kelamin"
                        value="Laki-Laki"
                    > Laki-Laki
                </td>
            </tr>

            <tr>
                <td>No HP</td>
                <td>:</td>
                <td>
                    <input
                        type="text"
                        name="no_hp"
                        size="20"
                        maxlength="15"
                    >
                </td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>
                    <textarea name="alamat" rows="4" cols="35" ></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" name="btnSimpan" value="Simpan" >
                </td>
            </tr>

        </table>
    </form>
</body>
</html>