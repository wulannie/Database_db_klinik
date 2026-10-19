<?php

include_once "../koneksi.php";
if (isset($_GET['id'])) {
    $id_pemeriksaan = $_GET['id'];
    $sql = mysqli_query(
        $koneksi,
        "DELETE FROM pemeriksaan
         WHERE id_pemeriksaan='$id_pemeriksaan'"
    );
    if ($sql) {

        echo "<center><b><font color='red' size='4'><p>Data Berhasil Dihapus</p></font></b></center>
                <meta http-equiv='refresh' content='2; url=index.php'>";

    } else {

        echo "<center> <b><font color='red' size='4'><p>Data Gagal Dihapus!</p></font></b></center>";
    }

} else {

    echo "<b>Data yang dihapus tidak ada</b>";
}

?>