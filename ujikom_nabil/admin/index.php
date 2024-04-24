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
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE userid");
$data = mysqli_fetch_array($query)                     
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
                    <a class="navbar-brand text-light btn btn-secondary fw-bold" href="profil.php?userid=<?php echo $userid = $_SESSION['userid']; ?>">Hi <?php echo $username = $_SESSION['username']; ?> </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div class="navbar-nav me-auto">
                        <a class="navbar-brand text-light fw-bold" href="index.php">Gallery </a>
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

                        <div class="col-4">
                            <div class="card mb-3 bg-primary " style="max-width: 400px; height:177px">

                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top  " title="<?php echo $data['judulfoto'] ?>" style="height: 11rem;">
                                    </div>
                                    <div class="col-md-8">
                                            <div class="card-body text-light text-start">
                                                    <h5 class="card-title fw-bold"><?php echo $data['judulfoto'] ?></h5>
                                                    <p class="card-text"><?php echo $data['deskripsifoto'] ?></p>
                                                    <p class="card-text mb-3"><?php echo $data['tanggalunggah'] ?></p>
                                            
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
                                                    <!-- komentar -->
                                                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="bi bi-chat-dots btn text-light" style="background-color: #474F7A;">
                                                            <?php
                                                            $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                                                            echo mysqli_num_rows($jmlkomen);
                                                            ?></i></a>

                                            </div>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top " style="width:55%;" title="<?php echo $data['judulfoto'] ?>">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="m-2">
                                                                    <div class="overflow-auto">
                                                                        <div class="sticky-top">
                                                                            <strong><?php echo $data['judulfoto'] ?></strong><br>
                                                                            <span class="badge bg-primary"><?php echo $data['namalengkap'] ?></span>
                                                                            <span class="badge bg-primary"><?php echo $data['tanggalunggah'] ?></span>
                                                                        </div>
                                                                        <hr>
                                                                        
                                                                        <em align="left">
                                                                            <?php echo $data['deskripsifoto'] ?>
                                                                        </em>
                                                                        <hr>
                                                                        <?php
                                                                        $fotoid = $data['fotoid'];
                                                                        $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid' AND user.userid = $userid");
                                                                        while ($row = mysqli_fetch_array($komentar)) {
                                                                        ?>
                                                                            <p align="left">
                                                                                <strong><?php echo $row['namalengkap'] ?>:</strong>
                                                                                <?php echo $row['isikomentar'] ?>
                                                                                <a href="../config/hapus_komentar.php?komentarid=<?php echo $row['komentarid'] ?>" class="btn text-danger" style="background-color: #EEEDEB;">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill mb-1" viewBox="0 0 16 16">
                                                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                                                </svg></a>
                                                                                
                                                                            </p>
                                                                        <?php } ?>
                                                                        <?php
                                                                        $fotoid = $data['fotoid'];
                                                                        $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid' AND user.userid != $userid");
                                                                        while ($row = mysqli_fetch_array($komentar)) {
                                                                        ?>
                                                                            <p align="left">
                                                                                <strong><?php echo $row['namalengkap'] ?>:</strong>
                                                                                <?php echo $row['isikomentar'] ?>
                                                                                
                                                                            </p>
                                                                        <?php } ?>
                                                                        <hr>
                                                                        <div class="sticky-bottom">
                                                                            <form action="../config/proses_komentar.php" method="POST">
                                                                                <div class="input-grup">
                                                                                    <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                                                    <input type="text" name="isikomentar" class="form-control" placeholder="Tambah Komentar">
                                                                                    <div class="input-group-prepend mt-2">
                                                                                        <button type="submit" name="kirimkomentar" class="btn btn-primary">Kirim</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


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