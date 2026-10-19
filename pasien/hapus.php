<?php

include_once "../koneksi.php";

// Mengambil ID pasien dari URL
$id_pasien = $_GET['id'];

// Menghapus data pasien
$sql = mysqli_query(
    $koneksi,
    "DELETE FROM pasien WHERE id_pasien='$id_pasien'"
);

// Mengecek hasil penghapusan
if ($sql) {

    echo "
    <center>
        <b>
            <font color='red' size='4'>
                <p>Data Berhasil Dihapus</p>
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
                <p>Data Gagal Dihapus!</p>
            </font>
        </b>
    </center>

    <meta http-equiv='refresh' content='2; url=index.php'>
    ";
}

exit;

?>