<?php 
    session_start();     
    

    if(isset($_SESSION['logged_user'])){
        header("location:index.php");        
    }
    
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('partials/global.php') ?>
    <?php include('partials/head.php'); ?>
        
    <title><?php echo $webname; ?> - Produk</title>  
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center p-4">
      <a href="index.php" class="h1"><img src="image/logo.jpg" alt="logo" class="img-fluid"></a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Login untuk melanjutkan sesi Anda</p>
        <form action="access/signin.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email atau Username" id="inputEmailAddress" name="user" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="inputPassword" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
