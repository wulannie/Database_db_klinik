<?php

include_once "../koneksi.php";

// Membaca ID pada URL

if (isset($_GET['id'])) {

    $id_dokter = $_GET['id'];

    // Hapus data sesuai ID

    $sql = mysqli_query(
        $koneksi,
        "DELETE FROM dokter WHERE id_dokter='$id_dokter'"
    );

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
    }

} else {

    echo "<b>Data yang dihapus tidak ada</b>";
}

?>