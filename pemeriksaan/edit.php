<?php

include_once "../koneksi.php";

if (isset($_POST['btnSimpan'])) {

    $id_pemeriksaan = $_POST['id_pemeriksaan'];
    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $tanggal = $_POST['tanggal'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $jenis_pembayaran = $_POST['jenis_pembayaran'];
    $total_biaya = $_POST['total_biaya'];

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

    if (count($pesanError) >= 1) {

        $noPesan = 0;

        foreach ($pesanError as $indeks => $pesan_tampil) {

            $noPesan++;

            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }

        echo "<br>";

    } else {

        $sqlEdit = mysqli_query(
            $koneksi,
            "UPDATE pemeriksaan SET
            id_pasien='$id_pasien',
            id_dokter='$id_dokter',
            tanggal='$tanggal',
            keluhan='$keluhan',
            diagnosa='$diagnosa',
            jenis_pembayaran = '$jenis_pembayaran',
            total_biaya = '$total_biaya'
            WHERE id_pemeriksaan='$id_pemeriksaan'"
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
            ";
        }

        exit;
    }
}


// Mengambil ID pemeriksaan dari URL

$id_pemeriksaan = $_GET['id'];


// Mengambil data pemeriksaan

$sqlEdit = mysqli_query(
    $koneksi,
    "SELECT * FROM pemeriksaan
     WHERE id_pemeriksaan='$id_pemeriksaan'"
);

$data = mysqli_fetch_array($sqlEdit);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Edit Pemeriksaan</title>

</head>

<body>

<form action="edit.php?id=<?php echo $id_pemeriksaan; ?>" method="post">

    <h2>EDIT DATA PEMERIKSAAN</h2>

    <table cellpadding="8">

        <tr>
            <td>ID PEMERIKSAAN</td>
            <td>:</td>
            <td>
                <input type="text" name="id_pemeriksaan" size="10" value="<?php echo $data['id_pemeriksaan']; ?>"readonly>
            </td>
        </tr>

        <tr>
            <td>PASIEN</td>
            <td>:</td>
            <td>
                <select name="id_pasien">

                    <?php

                    $tampilkanPasien = mysqli_query(
                        $koneksi,
                        "SELECT * FROM pasien"
                    );

                    while ($dataPasien = mysqli_fetch_array($tampilkanPasien)) {

                        if ($dataPasien['id_pasien'] == $data['id_pasien']) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }

                        echo "
                        <option value='" . $dataPasien['id_pasien'] . "' $selected>
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
                    <?php

                    $tampilkanDokter = mysqli_query(
                        $koneksi,
                        "SELECT * FROM dokter"
                    );

                    while ($dataDokter = mysqli_fetch_array($tampilkanDokter)) {

                        if ($dataDokter['id_dokter'] == $data['id_dokter']) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }

                        echo "<option value=" . $dataDokter['id_dokter'] . " $selected>" . $dataDokter['nama_dokter'] . "</option>";
                    }

                    ?>

                </select>
            </td>
        </tr>
        <tr>
            <td>TANGGAL</td>
            <td>:</td>
            <td>
                <input type="text" name="tanggal" value="<?php echo $data['tanggal']; ?>">
            </td>
        </tr>
        <tr>
            <td>KELUHAN</td>
            <td>:</td>
            <td>
                <textarea name="keluhan" rows="4" cols="35"><?php echo $data['keluhan']; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>DIAGNOSA</td>
            <td>:</td>
            <td>
                <textarea name="diagnosa" rows="4" cols="35"><?php echo $data['diagnosa']; ?></textarea>
            </td>
        </tr>


        <tr>
            <td>JENIS PEMBAYARAN</td>
            <td>:</td>
            <td>
                <select name="jenis_pembayaran" required>
                    <option value="BPJS"
                        <?php if ($data['jenis_pembayaran'] == 'BPJS') echo 'selected'; ?>>
                        BPJS
                    </option>

                    <option value="Umum"
                        <?php if ($data['jenis_pembayaran'] == 'Umum') echo 'selected'; ?>>
                        Umum
                    </option>
                </select>
            </td>
        </tr>

        <tr>
            <td>TOTAL BIAYA</td>
            <td>:</td>
            <td>
                <input type="number" name="total_biaya" min="0" step="1000" value="<?php echo $data['total_biaya']; ?>" required>
            </td>
        </tr>

        <tr>
        
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