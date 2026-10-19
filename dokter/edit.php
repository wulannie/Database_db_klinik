<?php

include_once "../koneksi.php";

// SKRIP TOMBOL SIMPAN DIKLIK

if (isset($_POST['btnSimpan'])) {

    $id_dokter = $_POST['id_dokter'];
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

        // Update data dokter

        $sqlEdit = mysqli_query(
            $koneksi,
            "UPDATE dokter SET

            nama_dokter='$nama_dokter',
            spesialis='$spesialis',
            no_hp='$no_hp'

            WHERE id_dokter='$id_dokter'"
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

$id_dokter = $_GET['id'];

$sqlEdit = mysqli_query(
    $koneksi,
    "SELECT * FROM dokter WHERE id_dokter='$id_dokter'"
);

$data = mysqli_fetch_array($sqlEdit);

?>

<form action="edit.php?id=<?php echo $id_dokter; ?>" method="post">

    <h2>EDIT DATA DOKTER</h2>

    <table cellpadding="8">

        <tr>
            <td>ID DOKTER</td>
            <td>:</td>
            <td>
                <input
                    name="id_dokter"
                    type="text"
                    size="10"
                    value="<?php echo $data['id_dokter']; ?>"
                    readonly
                />
            </td>
        </tr>

        <tr>
            <td>NAMA DOKTER</td>
            <td>:</td>
            <td>
                <input
                    name="nama_dokter"
                    type="text"
                    size="30"
                    maxlength="100"
                    value="<?php echo $data['nama_dokter']; ?>"
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
                    value="<?php echo $data['spesialis']; ?>"
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
                    value="<?php echo $data['no_hp']; ?>"
                />
            </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
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