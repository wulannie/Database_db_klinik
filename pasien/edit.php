<?php

include_once "../koneksi.php";

// SKRIP TOMBOL SIMPAN DIKLIK

if (isset($_POST['btnSimpan'])) {

    $id_pasien = $_POST['id_pasien'];
    $nama_pasien = $_POST['nama_pasien'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    // Validasi Form Inputs
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

        // Update data pasien

        $sqlEdit = mysqli_query(
            $koneksi,
            "UPDATE pasien SET

            nama_pasien='$nama_pasien',
            tanggal_lahir='$tanggal_lahir',
            jenis_kelamin='$jenis_kelamin',
            no_hp='$no_hp',
            alamat='$alamat'

            WHERE id_pasien='$id_pasien'"
        );

        if ($sqlEdit) {

            echo "
            <center>
                <b>
                    <font color='green' size='4'>
                        <p>Data Berhasil Diubah</p>
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
                        <p>Data Gagal Diubah!</p>
                    </font>
                </b>
            </center>

            <meta http-equiv='refresh' content='2; url=index.php'>
            ";
        }

        exit;
    }
}

// MEMBACA DATA DARI DATABASE UNTUK DIEDIT

$id_pasien = $_GET['id'];

$sqlEdit = mysqli_query(
    $koneksi,
    "SELECT * FROM pasien WHERE id_pasien='$id_pasien'"
);

$data = mysqli_fetch_array($sqlEdit);

?>

<form action="edit.php?id=<?php echo $id_pasien; ?>" method="post">

    <table cellspacing="1" cellpadding="3">

        <tr>
            <td bgcolor="#CCCCCC" colspan="3">
                <strong>EDIT DATA PASIEN</strong>
            </td>
        </tr>

        <tr>
            <td>ID PASIEN</td>
            <td>:</td>
            <td>
                <input
                    name="id_pasien"
                    type="text"
                    size="10"
                    value="<?php echo $data['id_pasien']; ?>"
                    readonly
                />
            </td>
        </tr>

        <tr>
            <td>NAMA PASIEN</td>
            <td>:</td>
            <td>
                <input
                    name="nama_pasien"
                    type="text"
                    size="30"
                    value="<?php echo $data['nama_pasien']; ?>"
                />
            </td>
        </tr>

        <tr>
            <td>TANGGAL LAHIR</td>
            <td>:</td>
            <td>
                <input
                    name="tanggal_lahir"
                    type="text"
                    value="<?php echo $data['tanggal_lahir']; ?>"
                />
            </td>
        </tr>

        <tr>
            <td>JENIS KELAMIN</td>
            <td>:</td>
            <td>

                <input
                    type="radio"
                    name="jenis_kelamin"
                    value="Perempuan"
                    <?php
                    if ($data['jenis_kelamin'] == "Perempuan") {
                        echo "checked";
                    }
                    ?>
                />
                Perempuan

                <input
                    type="radio"
                    name="jenis_kelamin"
                    value="Laki-Laki"
                    <?php
                    if ($data['jenis_kelamin'] == "Laki-Laki") {
                        echo "checked";
                    }
                    ?>
                />
                Laki-Laki

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
                    value="<?php echo $data['no_hp']; ?>"
                />
            </td>
        </tr>

        <tr>
            <td>ALAMAT</td>
            <td>:</td>
            <td>
                <textarea
                    name="alamat"
                    rows="4"
                    cols="35"
                ><?php echo $data['alamat']; ?></textarea>
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