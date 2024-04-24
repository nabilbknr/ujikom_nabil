<?php
session_start();;
include 'koneksi.php';
$komentarid = $_GET['komentarid'];
$userid = $_SESSION['userid'];

$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE komentarid='$komentarid'"));

if ($cek > 0) { {
        $delete = mysqli_query($koneksi, "DELETE FROM komentarfoto WHERE komentarid='$komentarid'");
        echo "<script>
        alert('Berhasil di hapus!');
        location.href='../admin/index.php';
        </script>";
    }
} else {
    
    echo "<script>
    location.href='../admin/index.php';
    </script>";
}