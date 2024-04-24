<?php
session_start();
include '../config/koneksi.php';
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

            
            <nav class="navbar navbar-expand-lg bg-primary">
                    <div class="container">
                    <a class="navbar-brand text-light btn btn-secondary fw-bold" href="profil.php?userid=<?php echo $data['userid']; ?>">Hi <?php echo $data['namalengkap'] ?></a>
                        
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <div class="navbar-nav me-auto">
                            <a class="navbar-brand text-light" href="index.php">Gallery </a>
                                <a class="navbar-brand text-light fw-bold" style="" href="foto.php">Foto</a>

                        </div>
                        <a href="../config/aksi_logout.php" class="btn btn-danger m-1">Keluar</a>
                    </div>
                </div>
            </nav>

            <hr style="width: 95%; color: black; margin-top:-4px">
            <br>

            <div class="container text-center text-dark">
                <div class="row">
                    <div class="col-8">
                        <div class="row justify-content-start">
                            <?php
                            $no = 1;
                            $userid = $_SESSION['userid'];
                            $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <div class="col-6">
                                    <div class="card mb-3 bg-primary" style="max-width: 400px; height:177px">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="../assets//img/<?php echo $data['lokasifile'] ?>" class="img-fluid rounded-start" style="height: 11rem;" alt="..." srcset="" >
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body text-light text-start">
                                                    <h5 class="card-title fw-bold"><?php echo $data['judulfoto'] ?></h5>
                                                    <p class="card-text"><?php echo $data['deskripsifoto'] ?></p>
                                                    <p><?php echo $data['tanggalunggah'] ?></p>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary bg-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square mb-1" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                    </svg>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="edit<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Edit Data</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                                                                        <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                                        <label class="form-label text-dark">Judul Foto</label>
                                                                        <input type="text" name="judulfoto" value="<?php echo $data['judulfoto'] ?>" class="form-control" required>
                                                                        <br>
                                                                        <label class="form-label text-dark">Deskripsi Foto</label>
                                                                        <textarea class="form-control" name="deskripsifoto" required><?php echo $data['deskripsifoto']; ?></textarea>
                                                                        <br>
                                                                        <label class="form-label text-dark">Foto</label>
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <img src="../assets//img/<?php echo $data['lokasifile'] ?>" width="100">
                                                                            </div>
                                                                            <div class="col-md-8">

                                                                                <label class="form-label">Ganti File</label>
                                                                                <input type="file" class="form-control" name="lokasifile">

                                                                            </div>
                                                                        </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                        <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill mb-1" viewBox="0 0 16 16">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                    </svg>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="hapus<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Hapus Data</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="../config/aksi_foto.php" method="POST" class="text-dark">
                                                                        <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                                        Apakah yakin akan menghapus data <strong><?php echo $data['judulfoto'] ?></strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" name="hapus" class="btn btn-primary">Hapus Data</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>

                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                            <h5 class="text-start">Add Image</h5>
                            <br>
                            <div class="mb-3">
                                <label for="foto" class="form-label text-secondary" style="margin-right:330px;">Image File</label>
                                <input class="form-control" type="file" name="lokasifile" required>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label text-secondary" style="margin-right:375px;">Title</label>
                                <input type="text" class="form-control" name="judulfoto" aria-describedby="emailHelp" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label text-secondary" style="margin-right:340px;">Deskripsi</label>
                                <input type="text" class="form-control" name="deskripsifoto" required>
                            </div>
                            <br>
                            <div class="d-grid gap-2">
                                <button class="btn text-light bg-primary" type="submit" name="tambah">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>





        </div>
    </center>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>