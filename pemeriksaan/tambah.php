<?php

include_once "../koneksi.php";

// SKRIP TOMBOL SIMPAN DIKLIK
if (isset($_POST['btnSimpan'])) {

    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $tanggal = $_POST['tanggal'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $jenis_pembayaran = $_POST['jenis_pembayaran'];
    $total_biaya = $_POST['total_biaya'];

    // Validasi Form Input
    $pesanError = array();

    if (trim($id_pasien) == "") {
        $pesanError[] = "Data <b>PASIEN</b> tidak boleh kosong!";
    }

    if (trim($id_dokter) == "") {
        $pesanError[] = "Data <b>DOKTER</b> tidak boleh kosong!";
    }

    if (trim($tanggal) == "") {
        $pesanError[] = "Data <b>TANGGAL</b> tidak boleh kosong!";
    }

    if (trim($keluhan) == "") {
        $pesanError[] = "Data <b>KELUHAN</b> tidak boleh kosong!";
    }

    if (trim($diagnosa) == "") {
        $pesanError[] = "Data <b>DIAGNOSA</b> tidak boleh kosong!";
    }

    if (trim($jenis_pembayaran) == "") {
        $pesanError[] = "Jenis pembayaran harus dipilih!";
    }

    if ($total_biaya == "" || !is_numeric($total_biaya) || $total_biaya < 0) {
        $pesanError[] = "Total biaya harus diisi dengan angka yang benar!";
    }




    // Menampilkan Pesan Error
    if (count($pesanError) >= 1) {
        $noPesan = 0;
        foreach ($pesanError as $indeks => $pesan_tampil) {
            $noPesan++;
            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "<br>";
    } else {
        // Simpan data pemeriksaan
        $sqlSimpan = mysqli_query(
            $koneksi,
            "INSERT INTO pemeriksaan
            (id_pasien, id_dokter, tanggal, keluhan, diagnosa, jenis_pembayaran, total_biaya)
            VALUES
            ('$id_pasien', '$id_dokter', '$tanggal', '$keluhan', '$diagnosa', '$jenis_pembayaran', '$total_biaya')"
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
            <meta http-equiv='refresh' content='2; url=index.php'>";
        } else {
            echo "
            <center><b> <font color='red' size='4'><p>Data Gagal Disimpan!</p></font></b></center>";
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Tambah Pemeriksaan</title>
</head>
<body>
    <form action="tambah.php" method="post">
        <h2>TAMBAH DATA PEMERIKSAAN</h2>
        <table cellpadding="8">
            <tr>
                <td>PASIEN</td>
                <td>:</td>
                <td>
                    <select name="id_pasien">
                        <option value="">.....</option>
                        <?php
                        $tampilkanPasien = mysqli_query(
                            $koneksi,
                            "SELECT * FROM pasien"
                        );
                        while ($dataPasien = mysqli_fetch_array($tampilkanPasien)) {
                            echo "
                            <option value='" . $dataPasien['id_pasien'] . "'>
                                " . $dataPasien['nama_pasien'] . "
                            </option>
                            ";
                        }

                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>DOKTER</td>
                <td>:</td>
                <td>
                    <select name="id_dokter">
                        <option value="">.....</option>
                        <?php
                        $tampilkanDokter = mysqli_query(
                            $koneksi,
                            "SELECT * FROM dokter"
                        );
                        while ($dataDokter = mysqli_fetch_array($tampilkanDokter)) {

                            echo "
                            <option value='" . $dataDokter['id_dokter'] . "'>
                                " . $dataDokter['nama_dokter'] . "
                            </option>
                            ";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>TANGGAL</td>
                <td>:</td>
                <td>
                    <input type="text" name="tanggal">
                </td>
            </tr>

            <tr>
                <td>KELUHAN</td>
                <td>:</td>
                <td>
                    <textarea name="keluhan" rows="4" cols="35"></textarea>
                </td>
            </tr>

            <tr>
                <td>DIAGNOSA</td>
                <td>:</td>
                <td>
                    <textarea name="diagnosa"rows="4"cols="35"></textarea>
                </td>
            </tr>

            <tr>
                <td>JENIS PEMBAYARAN</td>
                <td>:</td>
                <td>
                    <select name="jenis_pembayaran" required>
                            <option value="">Pilih Pembayaran</option>
                            <option value="BPJS">BPJS</option>
                            <option value="Umum">Umum</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>TOTAL BIAYA</td>
                <td>:</td>
                <td>
                    <input type="number" name="total_biaya" min="0" step="1000" required>
                </td>
            </tr>

            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" name="btnSimpan" value="Simpan">
                </td>
            </tr>
            
        </table>
    </form>
</body>
</html>