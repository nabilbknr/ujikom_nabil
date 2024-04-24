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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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

            <nav class="navbar navbar-expand-lg bg-primary">
                <div class="container">
                    <a class="navbar-brand text-light" href="index.php">Gallery Foto</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div class="navbar-nav me-auto">
                            <a class="navbar-brand text-light" href="foto.php">Foto</a>
                        </div>
                        <a href="../config/aksi_logout.php" class="btn bg-danger m-1 text-light">Keluar</a>
                    </div>
                </div>
            </nav>
            <hr style="width: 95%; color: black; margin-top:-4px">
            <br>

            <div class="container text-dark">
                <div class="row">


                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>

                        <div class="col-md-4">
                            <div class="card mb-3 bg-primary" style="max-width: 400px; height:177px">

                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top  " title="<?php echo $data['judulfoto'] ?>" style="height: 11rem;">
                                    </div>
                                    <div class="col-md-8">
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                                            <div class="card-body text-light text-start">
                                                <div class="sticky-top">
                                                    <h5 class="card-title fw-bold"><?php echo $data['judulfoto'] ?></h5>
                                                    <p class="card-text"><?php echo $data['deskripsifoto'] ?></p>
                                                    <p class="card-text mb-3"><?php echo $data['tanggalunggah'] ?></p>
                                                </div>

                                                <?php
                                                $fotoid = $data['fotoid'];
                                                $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

                                                if (mysqli_num_rows($ceksuka) == 1) {
                                                ?>
                                                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']; ?>" type="submit" name="batalsuka" class="btn text-secondary" style="background-color: #EEEDEB;"><i class="bi bi-heart-fill text-danger"></i>
                                                        <?php
                                                        $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                                        echo mysqli_num_rows($like); ?>
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']; ?>" type="submit" name="batalsuka" class="btn text-secondary" style="background-color: #EEEDEB;"><i class="bi bi-heart text-danger"></i>
                                                    <?php
                                                }

                                                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");

                                                    ?>
                                                    </a>
                                                    <a href="detail.php?fotoid=<?= $data["fotoid"]; ?>" type="button"><i class="bi bi-chat-dots btn text-light" style="background-color: #474F7A;">
                                                            <?php
                                                            $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                                                            echo mysqli_num_rows($jmlkomen);
                                                            ?></i></a>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>

            </div>
        </div>





        </div>
    </center>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>