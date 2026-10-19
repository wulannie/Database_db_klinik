<?php

include_once "../koneksi.php";

// SKRIP TOMBOL SIMPAN DIKLIK

if (isset($_POST['btnSimpan'])) {

    $nama_dokter = $_POST['nama_dokter'];
    $spesialis = $_POST['spesialis'];
    $no_hp = $_POST['no_hp'];

    // Validasi Form Inputs
    $pesanError = array();

    if (trim($nama_dokter) == "") {
        $pesanError[] = "Data <b>NAMA DOKTER</b> tidak boleh kosong!";
    }

    if (trim($spesialis) == "") {
        $pesanError[] = "Data <b>SPESIALIS</b> tidak boleh kosong!";
    }

    if (trim($no_hp) == "") {
        $pesanError[] = "Data <b>NO HP</b> tidak boleh kosong!";
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

        // Menyimpan data dokter

        $sqlSimpan = mysqli_query(
            $koneksi,
            "INSERT INTO dokter
            (nama_dokter, spesialis, no_hp)
            VALUES
            ('$nama_dokter', '$spesialis', '$no_hp')"
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

            <meta http-equiv='refresh' content='2; url=index.php'>
            ";
        }

        exit;
    }
}

?>

<form action="tambah.php" method="post">

    <table cellspacing="1" cellpadding="3">
            <h2>TAMBAH DATA DOKTER</h2>
            <table cellpadding="8">
        <tr>
            <td>NAMA DOKTER</td>
            <td>:</td>
            <td>
                <input
                    name="nama_dokter"
                    type="text"
                    size="30"
                    maxlength="100"
                />
            </td>
        </tr>

        <tr>
            <td>SPESIALIS</td>
            <td>:</td>
            <td>
                <input
                    name="spesialis"
                    type="text"
                    size="30"
                    maxlength="100"
                />
            </td>
        </tr>

        <tr>
            <td>NO HP</td>
            <td>:</td>
            <td>
                <input
                    name="no_hp"
                    type="text"
                    size="20"
                    maxlength="15"
                />
            </td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
                <input
                    name="btnSimpan"
                    type="submit"
                    value="Simpan"
                />
            </td>
        </tr>

    </table>

</form>