<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="index.php">Gallery Foto</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse mt-2" id="navbarNav">
        <div class="navbar-nav me-auto">

        </div>
        <a href="register.php" class="btn btn-outline-primary m-1">Daftar</a>
        <a href="login.php" class="btn btn-outline-primary m-1">Masuk</a>
      </div>
    </div>
  </nav>


  <!-- <div class="container mt-3">
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <img src="" class="card-img-top" title="" style="height: 12rem;">
          <div class="card-footer text-center">
            <a href=""><i class="bi bi-heart-fill"></i>10 suka</a>
            <a href=""><i class="bi bi-chat-dots"></i></i>3 komentar</a>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <center>
    <div class="card mb-3" style="width: 35%; margin-top: 10%;">
      <div class="card-header">
        LOGIN
      </div>

      <div class="card-body">
        <form action="action/login.php" method="post">
          <div class="mb-3">
            <label for="username" class="form-label" style="margin-left: -85%;">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label" style="margin-left: -85%;">Password</label>
            <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp">
          </div>

          <button class="btn btn-primary" type="submit" name="login">Login Now</button>
        </form>
      </div>
      <div class="card-footer text-body-secondary">
        <a href="daftar.php">Need an account? Sign up! </a>
        <br>
        <br>
      </div>
    </div>
  </center>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>

</html>