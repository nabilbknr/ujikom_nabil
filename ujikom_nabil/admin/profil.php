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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<style>
        body {
            background-color: brown;
        }
    </style>


    <div class="container py-5" style="margin-top: 2rem;">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="text-center">
                            <h5>Detail Account</h5>
                            <br>
                        </div>
                        <form action="config/aksi_register.php" method="post">
                            <label class="form-label">Username</label>
                            <br>
                            <input type="text" name="username" disabled readonly class="form-control" value="<?php echo $username = $_SESSION['username']; ?>" ><br>
                            <label class="form-label">Email</label>
                            <br>
                            <input type="email" name="email" disabled readonly class="form-control" value="<?php echo $email = $_SESSION['email']; ?>" ><br>
                            <label class="form-label">Nama Lengkap</label>
                            <br>
                            <input type="text" name="namalengkap" disabled readonly class="form-control" value="<?php echo $namalengkap = $_SESSION['namalengkap']; ?>" ><br>
                            <label class="form-label">Alamat</label>
                            <br>
                            <input type="text" name="alamat" disabled readonly class="form-control" value="<?php echo $alamat = $_SESSION['alamat']; ?>" ><br>
                            <div class="d-grid mt-2">
                                <a class="btn btn-primary" href="index.php" role="button">Back</a>

                            </div>

                            <br>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>

</html>