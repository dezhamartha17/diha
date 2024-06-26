<?php
session_start();
include 'connect.php'; // Pastikan file ini termasuk koneksi database Anda

if (isset($_POST['register'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = 1;

    // Lakukan query menggunakan prepared statement untuk keamanan
    $stmt = $connect->prepare("INSERT INTO users (username, email, password, id_roles) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $username, $email, $password, $role);

    if ($stmt->execute()) {
        header('location:index.php');
        exit();
    } else {
        echo "Gagal menyimpan user: " . $stmt->error;
    }

    $stmt->close();
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIHA BARBERSHOP/ register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" /> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
</head>
<!-- <body class="bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
              <h2>Silahkan mendaftar pada kolom dibawah ini,Diha barbershop</h2> 
              
              <form action="" method="post">
                <div class="form-group">
                    <label for="username">username:</label>
                    <input class="form-control" type="text" name="username" id="username">
                </div>
                <div class="form-group">
                    <label for="email">email:</label>
                    <input class="form-control"type="email" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="password">password:</label>
                    <input class="form-control"type="text" name="password" id="password">
                </div>
                <br>
                <input class="btn btn-success" type="submit" value="daftar" name="register">
              </form>
            </div>
        </div>
    </div>
</body> -->
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>DiHa</b>Barbershop</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" id="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" value="daftar" name="register" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="login.php" class="text-center">Saya sudah mempunyai akun!</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
</body>
</html>