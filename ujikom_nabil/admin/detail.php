<?php
session_start();
include '../config/koneksi.php';
$userid = $_SESSION['userid'];
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda Belum Login!');
    location.href='../index.php';
    </script>";
}

if (isset($_GET['fotoid'])) {
    $fotoid = $_GET['fotoid'];
} else {
    die("Error. No ID Selected!");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        body {
            background-color: #f2f5fc;
        }
    </style>
    <center>
        <div class="mt-5  bg-white text-white rounded shadow  mb-5 bg-body-tertiary rounded" style="width: 90%; height: 650px;">

            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid" style="margin-left: 20px;">

                    <div class="row justify-content-start">
                        <div class="col-8 text-dark mt-2 fw-bold">

                        </div>
                    </div>

                    <div class="topnav-right">
                        <a class="btn btn-danger" href="menu.php" role="button">Back</a>
                    </div>

                </div>
            </nav>
            <hr style="width: 95%; color: black; margin-top:-4px">
            <br>

            <div class="container text-center text-dark">
                <div class="row">
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid WHERE foto.fotoid='$fotoid'");

                    while ($data = mysqli_fetch_array($query)) {

                    ?>
                        <div class="col-8">
                            <div class="row justify-content-start">
                                <form action="" method="post">
                                    <figure class="figure">
                                        <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top  " title="<?php echo $data['judulfoto'] ?>" style="height: 11rem;">
                                        <!-- <figcaption class="figure-caption">A caption for the above image.</figcaption> -->
                                    </figure>
                                </form>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="sticky-top">
                                <strong><?php echo $data['judulfoto'] ?></strong><br>
                                <span class="badge bg-secondary"><?php echo $data['namalengkap'] ?></span>
                                <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                            </div>
                            <hr>
                            <p align="left">
                                <?php echo $data['deskripsifoto'] ?>
                            </p>
                            <hr>

                            <h5 class="text-start">Komentar</h5>

                            <br>
                            <div class="card">
                                <div class="card-body text-start">
                                    <?php
                                    $fotoid = $data['fotoid'];
                                    $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                                    while ($data = mysqli_fetch_array($komentar)) {
                                    ?>
                                        <p align="left">
                                            <strong><?php echo $data['namalengkap'] ?></strong>
                                            <?php echo $data['isikomentar'] ?>
                                        </p>
                                    <?php } ?>
                                </div>
                            </div>
                            <br>
                            <form action="../config/proses_komentar.php" method="POST">
                                <div class="mb-3" style="margin-top: 12%;">
                                
                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                <input type="text" class="form-control" name="isikomentar" placeholder="Tambahkan Komentar">
                                </div>
                                <br>
                                <div class="d-grid gap-2" style="margin-top: -5%;">
                                    <button class="btn text-light bg-primary" type="submit" name="kirimkomentar">Submit</button>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>





        </div>
    </center>
</body>

</html>